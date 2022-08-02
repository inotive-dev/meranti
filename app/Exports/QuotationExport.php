<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class QuotationExport implements FromView, ShouldAutoSize
{
    public $data;
    
    public function __construct($data)
    {
        $this->data = $data;
    }
    
    public function view(): View
    {
        return view('dashboard.quotation.exports.excel', $this->data);
    }
}
