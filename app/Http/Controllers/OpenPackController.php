<?php

namespace App\Http\Controllers;

use App\Models\PackingDetailM;
use App\Models\PackingM;
use Illuminate\Http\Request;

class OpenPackController extends Controller
{
    public function index(){
        // Select unique 'gm' and aggregate other fields
        $data = PackingM::select('gm')->distinct()->get();
        
        return view('Open-Packing.pages.admin.packing.index', compact('data'));
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
            'jenis' => $request->jenis,
            'shift' => $request->shift,
            'shift_leader' => $shift_leader,
            'operator' => $request->operator,
        ]);


        return redirect()->route('Open-Packing.admin.packing')->with('success','GM Has Been created');
    }

    public function add_gm($gm){
        return view('Open-Packing.pages.admin.packing.add-gm',compact('gm'));
    }

    public function store_gm(Request $request){
        // dd($request->all());
        $request->validate([
            'gm' => 'required|string|max:255',
            'attribute' => 'required|string|max:255',
            'b_label' => 'required|integer',
            'b_aktual' => 'required|integer',
            'stiker' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $cc = PackingM::where('gm',$request->gm)->value('id');
        // dd($cc);

        PackingDetailM::create([
            'packing_id' => $cc,
            'attribute' => $request->attribute, 
            'b_label' => $request->b_label,
            'b_aktual' => $request->b_aktual,
            'selisih' => $request->b_label - $request->b_aktual, 
            'persentase' => number_format(($request->b_label * 0.25) / 100, 4), 
            'stiker' => $request->stiker,
            'keterangan' => $request->keterangan,
        ]);
        

        return redirect()->route('Open-Packing.admin.packing')->with('success','Product Has Been created');
    }

    public function show($gm)
    {
        $cc = PackingM::where('gm', $gm)->value('id');
        // dd($cc);
        $data = PackingDetailM::where('packing_id',$cc)->get();

        // dd($data);
        return view('Open-Packing.pages.admin.packing.show',compact('data','gm'));
    }

    public function edit($id){
        $data = PackingDetailM::find($id);
        $gm = PackingM::where('id',$data->packing_id)->value('gm');
        // dd($gm);
        return view('Open-Packing.pages.admin.packing.edit',compact('data','gm'));
    }

    public function update(Request $request){
        $request->validate([
            // 'gm' => 'required|string|max:255',
            'attribute' => 'required|string|max:255',
            'b_label' => 'required|integer',
            'b_aktual' => 'required|integer',
            'stiker' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $data = PackingDetailM::find($request->id);
        $gm = PackingM::where('id',$data->packing_id)->value('gm');

        // $data->gm = $request->gm;
        $data->attribute = $request->attribute;
        $data->b_label = $request->b_label;
        $data->b_aktual = $request->b_aktual;
        $data->selisih = $request->b_label - $request->b_aktual;
        $data->persentase = number_format(($request->b_label * 0.25) / 100, 4);
        $data->stiker = $request->stiker;
        $data->keterangan = $request->keterangan;
        $data->update();

        return redirect()->route('Open-Packing.admin.packing.show',$gm)->with('success','Product Updated');
    }

    public function delete($id){
        PackingDetailM::find($id)->delete();

        return redirect()->back()->with('success', 'Data has been deleted');
    }

    public function print($gm){
        $data = PackingM::where('gm', $gm)->get();
        $cc = PackingM::where('gm',$gm)->value('id');
        $detail = PackingDetailM::where('packing_id',$cc)->get();
        $date = PackingM::where('gm',$gm)->value('created_at');
        $jenis = PackingM::where('gm',$gm)->value('jenis');
        $leader = PackingM::where('gm',$gm)->value('shift_leader');
        

        return view('Open-Packing.pages.admin.packing.print',compact('data','detail','date','jenis','leader'));
    }
}
