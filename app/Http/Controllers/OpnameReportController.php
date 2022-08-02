<?php

namespace App\Http\Controllers;

use App\Models\QuotationItem;
use App\Models\OpnameReport;
use Illuminate\Http\Request;
use App\Models\JobRequest;
use App\Models\Quotation;
use App\Models\Project;

class OpnameReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['project'] = Project::findOrFail($request->id);
        $data['job_requests'] = JobRequest::where('project_id', $request->id)->get();
        $data['quotations'] = Quotation::where('verification_client', 1)->whereHas('job_request', function($q) use($request)
        {
            $q->where('project_id', $request->id);
            $q->whereHas('job_request_items', function($q1){
               $q1->where('remarks', 1); 
            });
        })->get();
        $data['title'] = 'Detail Opname Report';
        
        return view('dashboard.opname-report.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OpnameReport  $opnameReport
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['quotation'] = Quotation::with('job_request.project.client')->findOrFail($id);
        $data['quotation_items'] = QuotationItem::whereDoesntHave('quotation_item_parent')->with('quotation_item_childs.quotation_item_childs')->where('quotation_id', $id)->get();
        $data['title'] = 'Opname Report Item';

        return view('dashboard.opname-report.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OpnameReport  $opnameReport
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = QuotationItem::findOrFail($id);
        
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OpnameReport  $opnameReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = QuotationItem::findOrFail($id);
        if($request->position == 'ppic')
        {
            $data->update([
               'verification_ppic' => $request->verification
            ]);
        } else {
            $data->update([
               'verification_production' => $request->verification
            ]);
        }
        
        return redirect()->back()->with('OK', 'Berhasil melakukan verifikasi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OpnameReport  $opnameReport
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
