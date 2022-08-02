<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobRequest;
use App\Models\WorkOrder;
use App\Models\Quotation;
use App\Models\Project;

class WorkOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Work Order';
        $data['projects'] = Project::orderBy('id')->get();
        
        return view('dashboard.work-order.index', $data);
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
     * @param  \App\Models\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['project'] = Project::findOrFail($id);
        $data['job_requests'] = JobRequest::where('project_id', $id)->get();
        $data['quotations'] = Quotation::where('verification_client', 1)->whereHas('job_request', function($q) use($id)
        {
            $q->where('project_id', $id);
            $q->whereHas('job_request_items', function($q1){
               $q1->where('remarks', 1); 
            });
        })->get();
        $data['title'] = 'Detail Work Order';
        
        return view('dashboard.work-order.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkOrder $workOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkOrder $workOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkOrder $workOrder)
    {
        //
    }
}
