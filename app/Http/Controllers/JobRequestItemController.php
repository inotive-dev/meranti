<?php

namespace App\Http\Controllers;

use App\Models\SettingJobRequest;
use App\Models\JobRequestItem;
use App\Models\QuotationItem;
use Illuminate\Http\Request;
use App\Models\JobRequest;
use App\Models\Quotation;

class JobRequestItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['job_request'] = JobRequest::with('project.client')->findOrFail($request->job_request_id);
        $data['job_request_items'] = JobRequestItem::whereDoesntHave('job_request_item_parent')->with('job_request_item_childs.job_request_item_childs')->where('job_request_id', $request->job_request_id)->get();
        $data['title'] = 'Job Request Item';

        return view('dashboard.job-request-item.index', $data);
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
        JobRequestItem::create([
            'job_request_id' => $request->job_request_id,
            'job_request_item_id' => $request->job_request_item_id,
            'name' => $request->name,
            'volume' => $request->volume,
            'unit' => $request->unit,
            'remarks' => $request->remarks,
            'remarks_reason' => $request->remarks_reason,
            'status' => $request->status
        ]);
        
        $jobRequestItemParent = JobRequestItem::find($request->job_request_item_id);
        if(!empty($jobRequestItemParent))
        {
            $jobRequestItemParent->update([
                'volume' => null,
                'unit' => null,
                'remarks' => null,
                'status' => null
            ]);
        }
        
        return redirect()->back()->with('OK', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobRequestItem  $jobRequestItem
     * @return \Illuminate\Http\Response
     */
    public function show(JobRequestItem $jobRequestItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobRequestItem  $jobRequestItem
     * @return \Illuminate\Http\Response
     */
    public function edit(JobRequestItem $jobRequestItem)
    {
        return $jobRequestItem;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobRequestItem  $jobRequestItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobRequestItem $jobRequestItem)
    {
        $jobRequestItem->update([
            'job_request_item_id' => $request->job_request_item_id,
            'name' => $request->name,
            'volume' => $request->volume,
            'unit' => $request->unit,
            'remarks_reason' => $request->remarks_reason,
            'status' => $request->status
        ]);
        
        if(!empty($request->job_request_item_id))
        {
            $childIds = JobRequestItem::where('job_request_item_id', $jobRequestItem->id)->pluck('id')->toArray();
            $subChildIds = JobRequestItem::whereIn('job_request_item_id', $childIds)->pluck('id')->toArray();
            if(in_array($request->job_request_item_id, $childIds) || in_array($request->job_request_item_id, $subChildIds))
            {
                $subChildIds = JobRequestItem::where('job_request_item_id', $jobRequestItem->id)->update([
                    'job_request_item_id' => null
                ]);
            }
        }
        
        $jobRequestItemParent = JobRequestItem::find($request->job_request_item_id);
        if(!empty($jobRequestItemParent))
        {
            $jobRequestItemParent->update([
                'volume' => null,
                'unit' => null,
                'remarks' => null,
                'status' => null
            ]);
        }
        
        return redirect()->back()->with('OK', 'Data berhasil diperbarui');
    }
    
    public function verification(Request $request)
    {
        if($request->job_request_id == null)
        {
            return redirect()->back()->with('ERR', 'Silahkan pilih data yang ingin diverifikasi.');    
        }
        
        JobRequest::where('id', $request->id)->update([
           'verification' => 1
        ]);
        
        JobRequestItem::whereIn('id', $request->job_request_id)->update([
           'verification' => 1
        ]);
        
        $quotation = Quotation::create([
            'job_request_id' => $request->id,
            'status' => 'menunggu',
        ]);
        
        $jobRequestItems = JobRequestItem::whereDoesntHave('job_request_item_parent')->with('job_request_item_childs.job_request_item_childs')->where('job_request_id', $request->id)->get();
        foreach($jobRequestItems as $key => $jobRequestItem)
        {
            $statusForeach = 0;
            if(count($jobRequestItem->job_request_item_childs) > 0)
            {
                if(count($jobRequestItem->approved_job_request_item_childs) < 1)
                {
                    foreach($jobRequestItem->job_request_item_childs as $key => $jobRequestItemChild)
                    {
                        if(count($jobRequestItemChild->job_request_item_childs) > 0)
                        {
                            if(count($jobRequestItemChild->approved_job_request_item_childs) < 1)
                            {
                                foreach($jobRequestItemChild->job_request_item_childs as $jobRequestItemSubChild)
                                {
                                    if($jobRequestItemSubChild->verification == 1)
                                    {
                                        $statusForeach = 1;
                                    }
                                }
                            } else {
                                $statusForeach = 1;            
                            }
                        }
                    }
                } else {
                    $statusForeach = 1;
                }
            } else {
                $statusForeach = 1;
            }
            
            
            if($statusForeach == 1)
            {
                if(count($jobRequestItem->job_request_item_childs) > 0)
                {
                    $quotationItem = QuotationItem::create([
                        'quotation_id' => $quotation->id,
                        'quotation_item_id' => null,
                        'job_request_item_id' => $jobRequestItem->id,
                        'name' => $jobRequestItem->name,
                    ]);
                } else {
                    if($jobRequestItem->verification == 1)
                    {
                       $quotationItem = QuotationItem::create([
                            'quotation_id' => $quotation->id,
                            'quotation_item_id' => null,
                            'job_request_item_id' => $jobRequestItem->id,
                            'name' => $jobRequestItem->name,
                        ]); 
                    }
                }
                foreach($jobRequestItem->job_request_item_childs as $key => $jobRequestItemChild)
                {
                    if(count($jobRequestItemChild->job_request_item_childs) > 0)
                    {
                        $quotationItemChild = QuotationItem::create([
                            'quotation_id' => $quotation->id,
                            'quotation_item_id' => $quotationItem->id,
                            'job_request_item_id' => $jobRequestItemChild->id,
                            'name' => $jobRequestItemChild->name,
                        ]);
                    } else {
                        if($jobRequestItemChild->verification == 1)
                        {
                           $quotationItemChild = QuotationItem::create([
                                'quotation_id' => $quotation->id,
                                'quotation_item_id' => $quotationItem->id,
                                'job_request_item_id' => $jobRequestItemChild->id,
                                'name' => $jobRequestItemChild->name,
                            ]);
                        }
                    }
                    foreach($jobRequestItemChild->job_request_item_childs as $key => $jobRequestItemSubChild)
                    {
                        if(count($jobRequestItemSubChild->job_request_item_childs) > 0)
                        {
                            $quotationItemSubChild = QuotationItem::create([
                                'quotation_id' => $quotation->id,
                                'quotation_item_id' => $quotationItemChild->id,
                                'job_request_item_id' => $jobRequestItemSubChild->id,
                                'name' => $jobRequestItemSubChild->name,
                            ]);
                        } else {
                            if($jobRequestItemSubChild->verification == 1)
                            {
                               $quotationItemSubChild = QuotationItem::create([
                                    'quotation_id' => $quotation->id,
                                    'quotation_item_id' => $quotationItemChild->id,
                                    'job_request_item_id' => $jobRequestItemSubChild->id,
                                    'name' => $jobRequestItemSubChild->name,
                                ]); 
                            }
                        }
                        
                    }
                }
            }
        }
        
        return redirect()->back()->with('OK', 'Data berhasil di verifikasi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobRequestItem  $jobRequestItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobRequestItem $jobRequestItem)
    {
        $jobRequestItem->delete();
        
        return redirect()->back()->with('OK', 'Data berhasil dihapus');
    }
}
