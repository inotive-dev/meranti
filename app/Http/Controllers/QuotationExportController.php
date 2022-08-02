<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Exports\QuotationExport;
use Excel;

class QuotationExportController extends Controller
{
    public function __invoke($id)
    {
        return $this->export($id);
    }
    
    public function export($id)
    {
        $data['quotation'] = Quotation::with('job_request.project.client')->find($id);
        $data['quotation_items'] = QuotationItem::whereDoesntHave('quotation_item_parent')->with('quotation_item_childs.quotation_item_childs')->where('quotation_id', $id)->get();
        $data['title'] = 'Quotation';
        return Excel::download(new QuotationExport($data), 'JR.xlsx');

        // return view('dashboard.quotation.exports.excel', $data);
    }
}
