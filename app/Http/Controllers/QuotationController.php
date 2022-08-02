<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Quotation;
use App\Models\QuotationItem;  
use App\Models\JobRequest;
use App\Models\JobRequestItem;
use App\Models\SettingQuotation;  
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['project'] = Project::findOrFail($request->project_id);
        $data['job_requests'] = JobRequest::where('project_id', $request->project_id)->get();
        $data['quotations'] = Quotation::whereHas('job_request', function($q) use($request)
        {
            $q->where('project_id', $request->project_id);
        })->get();
        $data['title'] = 'Quotation';
        
        return view('dashboard.quotation.index', $data);
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
        $quotation = Quotation::create([
            'job_request_id' => $request->job_request_id,
            'status' => 'menunggu',
        ]);
        
        $jobRequestItems = JobRequestItem::whereDoesntHave('job_request_item_parent')->with('job_request_item_childs.job_request_item_childs')->where('job_request_id', $request->job_request_id)->get();
        foreach($jobRequestItems as $key => $jobRequestItem)
        {
            $quotationItem = QuotationItem::create([
                'quotation_id' => $quotation->id,
                'quotation_item_id' => null,
                'name' => $jobRequestItem->name,
            ]);
            foreach($jobRequestItem->job_request_item_childs as $key => $jobRequestItemChild)
            {
                $quotationItemChild = QuotationItem::create([
                    'quotation_id' => $quotation->id,
                    'quotation_item_id' => $quotationItem->id,
                    'name' => $jobRequestItemChild->name,
                ]);
                foreach($jobRequestItemChild->job_request_item_childs as $key => $jobRequestItemSubChild)
                {
                    $quotationItemSubChild = QuotationItem::create([
                        'quotation_id' => $quotation->id,
                        'quotation_item_id' => $quotationItemChild->id,
                        'name' => $jobRequestItemSubChild->name,
                    ]);
                    
                }
            }
        }
        
        return redirect()->back()->with('OK', 'Data berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function show(Quotation $quotation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function edit(Quotation $quotation)
    {
        return $quotation;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quotation $quotation)
    {
        $quotation->update([
            'status' => $request->status,
        ]);
        
        return redirect()->back()->with('OK', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quotation $quotation)
    {
        $quotation->delete();
        
        return redirect()->back()->with('OK', 'Data berhasil dihapus.');
    }
}
