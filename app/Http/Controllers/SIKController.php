<?php

namespace App\Http\Controllers;

use App\Models\SuratM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SIKController extends Controller
{
    public function index(Request $request)
    {
        // Get the filter and search values from the request
        $filter = $request->get('filter', 'today');
        $search = $request->get('search');
    
        // Start the query with the base condition
        $query = SuratM::where('status', '!=', '1');
    
        // Apply the filter
        if ($filter == 'today') {
            $today = now()->toDateString();
            $query->where('date', $today);
        } elseif ($filter == 'month') {
            $monthStart = now()->startOfMonth()->toDateString();
            $monthEnd = now()->endOfMonth()->toDateString();
            $query->whereBetween('date', [$monthStart, $monthEnd]);
        } elseif ($filter == 'year') {
            $yearStart = now()->startOfYear()->toDateString();
            $yearEnd = now()->endOfYear()->toDateString();
            $query->whereBetween('date', [$yearStart, $yearEnd]);
        }elseif($filter == 'keluar'){
            $query = SuratM::where('status', '!=', 0);
        }
    
        // Apply the search condition if search is provided
        if ($search) {
            $query->where('no_kendaraan', 'like', '%' . $search . '%');
        }
    
        // Execute the query
        $data = $query->get();
    
        return view('Surat-Izin-Keluar.pages.index', compact('data'));
    }
    


    public function add(){
        $today = now()->toDateString();
        $currentMonth = now()->format('m');
        
        // Get the last record for the current month
        $lastSik = SuratM::whereMonth('created_at', $currentMonth)
                         ->orderByDesc('created_at')
                         ->first();
        
        // Determine the new number for the current month
        $lastNumber = $lastSik ? (int) substr($lastSik->kode_sik, 0, 3) : 0;
        
        // Increment the last number by 1, and reset to '001' if it's a new month
        $newKodeNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        // dd($newKodeNumber);
        // Generate the new code with the current date
        $kode = $newKodeNumber . '/sik/' . $today . '/tml';
        
        return view('Surat-Izin-Keluar.pages.cc', compact('kode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'kode_sik' => 'required|string',
            'bagian' => 'required|string',
            'no_kendaraan' => 'required|string',
            'pengemudi' => 'required|string',
            'muatan' => 'required|string',
            'pemberi_izin' => 'required|string',
            'signature' => 'required|string', 
        ]);

        $suratIzinKeluar = new SuratM();
        $suratIzinKeluar->date = $request->input('date');
        $suratIzinKeluar->status = 0;
        $suratIzinKeluar->kode_sik = $request->input('kode_sik');
        $suratIzinKeluar->bagian = $request->input('bagian');
        $suratIzinKeluar->no_kendaraan = $request->input('no_kendaraan');
        $suratIzinKeluar->pengemudi = $request->input('pengemudi');
        $suratIzinKeluar->muatan = $request->input('muatan');
        $suratIzinKeluar->keperluan = $request->input('keperluan');
        $suratIzinKeluar->pemberi_izin = $request->input('pemberi_izin');
        
        if ($request->has('signature')) {
            $signatureData = $request->input('signature');
            $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
            $signatureData = base64_decode($signatureData);

            $signatureFileName = 'signature_' . time() . '.png';
            Storage::disk('public')->put('signatures/' . $signatureFileName, $signatureData);

            $suratIzinKeluar->pemberi_izin_ttd = 'storage/signatures/' . $signatureFileName;
        }

        $suratIzinKeluar->save();

        return redirect()->route('sik')->with('success', 'Surat Izin Keluar created successfully!');
    }

    public function delete($id){
        $data = SuratM::find($id);
        $data->delete();
        return redirect()->back()->with('success','Data has been deleted');
    }

    public function edit($id){
        $data = SuratM::find($id);
        return view('Surat-Izin-Keluar.pages.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->signature == "sama");
        $request->validate([
            'date' => 'required|date',
            'kode_sik' => 'required|string',
            'bagian' => 'required|string',
            'no_kendaraan' => 'required|string',
            'pengemudi' => 'required|string',
            'muatan' => 'required|string',
            'pemberi_izin' => 'required|string',
            'signature' => 'nullable|string', // Signature is optional in case user doesn't change it
        ]);

        $suratIzinKeluar = SuratM::findOrFail($id);
        $suratIzinKeluar->date = $request->input('date');
        $suratIzinKeluar->kode_sik = $request->input('kode_sik');
        $suratIzinKeluar->bagian = $request->input('bagian');
        $suratIzinKeluar->no_kendaraan = $request->input('no_kendaraan');
        $suratIzinKeluar->pengemudi = $request->input('pengemudi');
        $suratIzinKeluar->muatan = $request->input('muatan');
        $suratIzinKeluar->keperluan = $request->input('keperluan');
        $suratIzinKeluar->pemberi_izin = $request->input('pemberi_izin');
        if($request->signature == "sama"){

        }else{
            if ($request->filled('signature')) {
                $signatureData = $request->input('signature');
                $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
                $signatureData = base64_decode($signatureData);
    
                $signatureFileName = 'signature_' . time() . '.png';
                
                // Delete the old signature file if it exists
                if ($suratIzinKeluar->pemberi_izin_ttd && Storage::disk('public')->exists($suratIzinKeluar->pemberi_izin_ttd)) {
                    Storage::disk('public')->delete($suratIzinKeluar->pemberi_izin_ttd);
                }
                
                // Store the new signature file
                Storage::disk('public')->put('signatures/' . $signatureFileName, $signatureData);
                $suratIzinKeluar->pemberi_izin_ttd = 'storage/signatures/' . $signatureFileName;
            }
        }
        // Handle new signature if provided

        $suratIzinKeluar->save();

        return redirect()->route('sik')->with('success', 'Surat Izin Keluar updated successfully!');
    }

    public function print($id){
        $data = SuratM::find($id);
        return view('Surat-Izin-Keluar.pages.print',compact('data'));
    }


    public function security(Request $request){
         // Get the filter and search values from the request
         $filter = $request->get('filter', 'today');
         $search = $request->get('search');
     
         // Start the query with the base condition
         $query = SuratM::where('status', 0);
     
         // Apply the filter
         if ($filter == 'today') {
             $today = now()->toDateString();
             $query->where('date', $today);
         } elseif ($filter == 'month') {
             $monthStart = now()->startOfMonth()->toDateString();
             $monthEnd = now()->endOfMonth()->toDateString();
             $query->whereBetween('date', [$monthStart, $monthEnd]);
         } elseif ($filter == 'year') {
             $yearStart = now()->startOfYear()->toDateString();
             $yearEnd = now()->endOfYear()->toDateString();
             $query->whereBetween('date', [$yearStart, $yearEnd]);
         }elseif($filter == 'keluar'){
             $query = SuratM::where('status', '!=', 0);
         }
     
         // Apply the search condition if search is provided
         if ($search) {
             $query->where('no_kendaraan', 'like', '%' . $search . '%');
         }
     
         // Execute the query
         $data = $query->get();
        return view('Surat-Izin-Keluar.pages.security',compact('data'));
    }

    public function setujui($id){
        $data = SuratM::find($id);
        $kode = 'aaa';
        return view('Surat-Izin-Keluar.pages.setujui',compact('data','kode'));
    } 

    public function setujui_store(Request $request){
        // dd($request->all());
        $request->validate([
            'jam' => 'required',
            'id' => 'required|string',
            'security' => 'required|string',
            'signature' => 'required|string', 
            'signature1' => 'required|string', 
        ]);

        $suratIzinKeluar = SuratM::find($request->id);
        $suratIzinKeluar->satpam = $request->input('security');
        $suratIzinKeluar->diizinkan = $request->input('jam');
        $suratIzinKeluar->status = 1;
        
        if ($request->has('signature')) {
            $signatureData = $request->input('signature');
            $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
            $signatureData = base64_decode($signatureData);

            $signatureFileName = 'signature_' . time() . '.png';
            Storage::disk('public')->put('signatures/' . $signatureFileName, $signatureData);

            $suratIzinKeluar->pengemudi_ttd = 'storage/signatures/' . $signatureFileName;
        }
        if ($request->has('signature1')) {
            $signatureData = $request->input('signature1');
            $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
            $signatureData = base64_decode($signatureData);

            $signatureFileName = 'signature_' . time() . '.png';
            Storage::disk('public')->put('signatures/' . $signatureFileName, $signatureData);

            $suratIzinKeluar->satpam_ttd = 'storage/signatures/' . $signatureFileName;
        }

        $suratIzinKeluar->save();

        return redirect()->route('security')->with('success','SIK telah disetujui');
    }


    
}
