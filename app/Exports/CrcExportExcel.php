<?php

namespace App\Exports;

use App\Models\CrcM;
use App\Models\EupM;
use App\Models\KendaraanM;
use App\Models\ResinM;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;

class CrcExportExcel implements FromView, ShouldAutoSize
{
    use Exportable;

    private $data;

    public function __construct()
    {
        $this->data = CrcM::all();
    }

    public function view() : View
    {
        return view('Form-Check.pages.material.crc.export', [
            'data' => $this->data
        ]);
    }
}
