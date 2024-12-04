<?php

namespace App\Http\Controllers;

use App\Exports\OpenPackExportExcel;
use App\Imports\ImportGM;
use App\Models\PackingDetailM;
use App\Models\PackingM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Svg\Tag\Rect;

class OpenPackController extends Controller
{
    public function index(Request $request)
    {
        // Mulai query dari model PackingM
        $query = PackingDetailM::query();

        // Filter berdasarkan rentang tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        // Filter berdasarkan bulan
        if ($request->filled('month')) {
            $query->whereMonth('created_at', $request->month);
        }

        // Filter berdasarkan tahun
        if ($request->filled('year')) {
            $query->whereYear('created_at', $request->year);
        }

        // Filter berdasarkan teks pencarian
        if ($request->filled('search')) {
            $query->where('gm', 'like', '%' . $request->search . '%')
            ;
        }
        // Ambil data unik 'gm' dengan tanggal pertama yang ditemukan
        $data = $query->select('gm', DB::raw('MIN(created_at) as created_at'))
        ->groupBy('gm')
        ->get();

        // Query untuk mencari berdasarkan 'attribute'
        $attributeSearch = PackingDetailM::query();
        if ($request->filled('search')) {
            $attributeSearch->where('attribute', 'like', '%' . $request->search . '%');
        }
        
        $att = $attributeSearch->get(); 
        // dd($att);

        // Kirim data ke view
        return view('Open-Packing.pages.admin.packing.index', compact('data','att'));
    }
    
    

    public function add()
    {
        return view('Open-Packing.pages.admin.packing.add');
    }

    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'gm' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'shift' => 'required|string|max:255',
            'shift_leader' => 'required|string|max:255',
            'operator' => 'required|string|max:255',
        ]);

        $shift_leader = $request->shift_leader == 'other' ? $request->other_shift_leader : $request->shift_leader;

        PackingM::create([
            'gm' => $request->gm,
            // 'jenis' => $request->jenis,
            'shift' => $request->shift,
            'shift_leader' => $shift_leader,
            'operator' => $request->operator,
        ]);


        return redirect()->route('Open-Packing.admin.packing')->with('success','GM Has Been created');
    }

    public function add_gm(){
        return view('Open-Packing.pages.admin.packing.add-gm');
    }

    public function store_gm(Request $request){
        // dd($request->all());
        $request->validate([
            'attribute' => 'required|string|max:255',
            'b_aktual' => 'required|integer',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $cc = PackingDetailM::where('attribute',$request->attribute)->value('id');
        $data = PackingDetailM::find($cc);
        $data->b_aktual = $request->b_aktual;
        $data->selisih = $request->b_aktual - $data->b_label;
        $data->persentase = number_format($data->selisih / $data->b_label * 100, 2);
        $data->keterangan = $request->keterangan;
        $data->scanner = Auth::user()->id;
        $data->save();
        

        return redirect()->route('Open-Packing.admin.packing.show',$data->gm)->with('success','Product Has Been Scanned');
    }

    public function show($gm)
    {
        // $cc = PackingM::where('gm', $gm)->value('id');
        // dd($cc);
        $data = PackingDetailM::where('gm',$gm)->get();

        // dd($data);
        return view('Open-Packing.pages.admin.packing.show',compact('data','gm'));
    }

    public function edit($id){
        $data = PackingDetailM::find($id);
        // $gm = PackingM::where('id',$data->packing_id)->value('gm');
        // dd($gm);
        return view('Open-Packing.pages.admin.packing.edit',compact('data'));
    }

    public function update(Request $request){
        $request->validate([
            'gm' => 'nullable|string|max:255',
            'attribute' => 'nullable|string|max:255',
            'b_label' => 'nullable|integer',
            'b_aktual' => 'nullable|integer',
            'keterangan' => 'nullable|string|max:255',
            'scanner' => 'nullable|string|max:255',
        ]);
        // dd($request->all());
        $data = PackingDetailM::find($request->id);
        // dd($data);
        // $gm = PackingM::where('id',$data->packing_id)->value('gm');

        // $data->gm = $request->gm;
        $data->attribute = $request->attribute;
        $data->b_label = $request->b_label;
        $data->b_aktual = $request->b_aktual;
        $data->selisih = $request->b_aktual - $request->b_label;
        $data->persentase = number_format($data->selisih / $request->b_label * 100, 2);
        $data->keterangan = $request->keterangan;
        $data->scanner = $request->scanner;
        $data->update();

        return redirect()->route('Open-Packing.admin.packing.show',$data->gm)->with('success','Product Updated');
    }

    public function delete($id){
        PackingDetailM::find($id)->delete();

        return redirect()->back()->with('success', 'Data has been deleted');
    }

    public function delete_gm($id){
        // $ids = PackingM::where('gm',$id)->value('id'); 
        // $data = PackingM::find($ids);
        // $data->delete();

        $detail = PackingDetailM::where('gm',$id)->get();
        foreach ($detail as $d){
            $hapus = PackingDetailM::find($d->id);
            $hapus->delete();
        }

        return redirect()->back()->with('success', 'Data has been deleted');
    }

    public function print($gm){
        $data = PackingDetailM::where('gm', $gm)->get();
        $cc = PackingDetailM::where('gm',$gm)->value('id');
        $detail = PackingDetailM::where('id',$cc)->get();
        $date = PackingDetailM::where('gm',$gm)->value('created_at');
        $jenis = "cc";
        $leader = PackingDetailM::where('gm',$gm)->value('shift_leader');
        $shift = PackingDetailM::where('gm',$gm)->value('shift');
        

        return view('Open-Packing.pages.admin.packing.print',compact('data','detail','date','jenis','leader','shift'));
    }

    public function download($gm){
        $data = PackingDetailM::where('gm',$gm)->get();
        $date = PackingDetailM::where('gm',$gm)->value('created_at');
        $leader = PackingDetailM::where('gm',$gm)->value('shift_leader');
        $shift = PackingDetailM::where('gm',$gm)->value('shift');
    return Excel::download(new OpenPackExportExcel($data,$gm,$date,$leader,$shift), $gm.'_open_packing-report.xlsx');

    }

    public function excel(Request $request){
        // $request->validate([
        //     'excel_file' => 'required|file|mimes:xls,xlsx|max:2048', // max size in KB
        // ]);
        $shift = $request->shift;
        $shift_leader = $request->shift_leader ? $request->shift_leader : $request->other_shift_leader;

        Excel::import(new ImportGM($shift,$shift_leader), $request->file('excel_file'));
    
        return back()->with('success', 'File imported successfully!');
    }
    
}
