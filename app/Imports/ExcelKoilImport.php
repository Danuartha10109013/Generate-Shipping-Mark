<?php

namespace App\Imports;

use App\Models\Coil;
use App\Models\MapCoil;
use App\Models\MapCoilTruck;
use App\Models\Pengecekan;
use App\Models\Shipment;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class ExcelKoilImport implements ToCollection, ToModel
{
    private $current = 0;
    private $isFirstProcessed = false; // To track the first data row

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // Uncomment if you want to inspect the data
        // dd($collection);
    }

    public function model(array $row)
    {
        $this->current++;
        
        if ($this->current > 1) { // Skip the header row
            $count = Coil::where('kode_produk', $row[1])->count();
            
            if ($count === 0) {
                $coil = new Coil;
                $coil->kode_produk = $row[1];
                $coil->nama_produk = $row[0];
                $coil->berat_produk = $row[2];
                $coil->diameter_produk = null;
                $coil->lebar_produk = null;
                $coil->keterangan = null;
                $coil->no_gs = $row[3];
                $coil->save();
            }

            // Process only for the first data row
            if (!$this->isFirstProcessed) {
                $shipment = new Shipment();
                $shipment->no_gs = $row[3]; 
                $shipment->save();

                $pengecekan = new Pengecekan();
                $pengecekan->no_gs = $row[3]; 
                $pengecekan->save();

                $mapcoil = new MapCoil();
                $mapcoil->no_gs = $row[3]; 
                $mapcoil->save();

                $mapcoilTruck = new MapCoilTruck();
                $mapcoilTruck->no_gs = $row[3]; 
                $mapcoilTruck->save();

                $this->isFirstProcessed = true; // Mark the first row as processed
            }
        }
    }
}
