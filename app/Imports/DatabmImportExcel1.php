<?php

namespace App\Imports;

use App\Models\DatabM;
use App\Models\ShipA;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DatabMImportExcel1 implements ToCollection,ToModel
{
    private $current = 0;
    private $satuan_berat;

    /**
    * @param Collection $collection
    */
    
    public function collection(Collection $collection)
    {
        $this->current++;
        }
        public function model(array $row)
        {
        $this->current++;
        if ($this->current > 1) {
            // dd($row);
            $count = DatabM::where('attribute', $row[4])->count();
            if (empty($count)) {
                $data = new DatabM();
                $data->kode = $row[0];
                $data->nama_produk = $row[1];
                $data->qty = str_replace(',', '', $row[2]); // Remove commas from qty
                $data->uom = $row[3];
                $data->attribute = $row[4];
                $data->storage_bin = $row[5];
                $data->panjang = $row[7];

                // Convert Excel date format to 'Y-m-d'
                $data->date = is_numeric($row[6]) 
                    ? Date::excelToDateTimeObject($row[6])->format('Y-m-d') 
                    : null;

                $data->user_id = Auth::user()->id;
                $data->save();
                // dd($data);
            }
            
        }
    }
}