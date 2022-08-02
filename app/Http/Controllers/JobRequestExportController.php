<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobRequest;
use App\Models\JobRequestItem;
use App\Exports\JobRequestExport;
use Excel;

class JobRequestExportController extends Controller
{
    public function __invoke($id)
    {
        return $this->export($id);
    }
    
    public function export($id)
    { 
        $data['job_request'] = JobRequest::with('project.client')->findOrFail($id);
        $data['job_request_items'] = JobRequestItem::whereDoesntHave('job_request_item_parent')->with('job_request_item_childs.job_request_item_childs')->where('job_request_id', $id)->get();
        // return view('dashboard.job-request.exports.excel', $data);
        return Excel::download(new JobRequestExport($data), 'JR.xlsx');
    }
}
