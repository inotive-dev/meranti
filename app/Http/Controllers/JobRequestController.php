<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\JobRequest;
use App\Models\JobRequestItem;  
use App\Models\SettingJobRequest;  
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class JobRequestController extends Controller
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
        $data['users'] = User::get();
        $data['title'] = 'Job Request';
        
        return view('dashboard.job-request.index', $data);
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
        $jobRequest = JobRequest::create([
            'project_id' => $request->project_id,
            'number' => $request->number,
            'revision' => $request->revision,
            'reference' => $request->reference,
            'type' => $request->type ?? 'baru',
            'created_user_id' => Auth::user()->id,
            'user_id' => $request->user_id
        ]);
        
        if($jobRequest->type == 'baru')
        {
            $settingJobRequests = SettingJobRequest::whereDoesntHave('r_setting_job_request_parent')->with('r_setting_job_request_childs.r_setting_job_request_childs')->get();
            foreach($settingJobRequests as $key => $settingJobRequest)
            {
                $jobRequestItem = JobRequestItem::create([
                    'job_request_id' => $jobRequest->id,
                    'name' => $settingJobRequest->title,
                    'unit' => $settingJobRequest->unit
                ]);
                if(count($settingJobRequest->r_setting_job_request_childs) > 0 )
                {
                    foreach($settingJobRequest->r_setting_job_request_childs as $key2 => $settingJobRequestChild)
                    {
                        $jobRequestSubItem = JobRequestItem::create([
                            'job_request_id' => $jobRequest->id,
                            'job_request_item_id' => $jobRequestItem->id,
                            'name' => $settingJobRequestChild->title,
                            'unit' => $settingJobRequestChild->unit
                        ]);
                    }
                    
                    if(count($settingJobRequestChild->r_setting_job_request_childs) > 0 )
                    {
                        foreach($settingJobRequestChild->r_setting_job_request_childs as $key3 => $settingJobRequestSubChild)
                        {
                            JobRequestItem::create([
                                'job_request_id' => $jobRequest->id,
                                'job_request_item_id' => $jobRequestSubItem->id,
                                'name' => $settingJobRequestSubChild->title,
                                'unit' => $settingJobRequestSubChild->unit
                            ]);
                        }
                    }
                }
            }
        }
        
        return redirect()->back()->with('OK', 'Data berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobRequest  $jobRequest
     * @return \Illuminate\Http\Response
     */
    public function show(JobRequest $jobRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobRequest  $jobRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(JobRequest $jobRequest)
    {
        return $jobRequest;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobRequest  $jobRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobRequest $jobRequest)
    {
        $jobRequest->update([
            'number' => $request->number,
            'revision' => $request->revision,
            'reference' => $request->reference,
        ]);
        
        return redirect()->back()->with('OK', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobRequest  $jobRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobRequest $jobRequest)
    {
        $jobRequest->delete();
        
        return redirect()->back()->with('OK', 'Data berhasil dihapus.');
    }
}
