<?php

namespace App\Http\Controllers;

use App\Models\SettingJobRequest;
use Illuminate\Http\Request;

class SettingJobRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['title'] = 'Setting Job Request';
      $data['setting_job_request'] = SettingJobRequest::where('level', 1)->orderBy('id')->get();

      return view('dashboard.setting.job-request.index', $data);
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
       SettingJobRequest::create([
         'setting_job_request_id' => $request->setting_job_request_id,
         'title' => $request->title,
         'unit' => $request->unit,
         'level' => $request->level,
       ]);

       return redirect()->back()->with('OK', 'Data berhasil ditambah');
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SettingJobRequest  $settingJobRequest
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $data['title'] = 'Setting Job Request';
      $data['setting_job_request'] = SettingJobRequest::where('id', $id)->first();

      return view('dashboard.setting.job-request.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SettingJobRequest  $settingJobRequest
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
     {
         $data = SettingJobRequest::findOrFail($id);

         return $data;
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SettingJobRequest  $settingJobRequest
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
     {
         $data = SettingJobRequest::findOrFail($id);

         $data->update([
            'title' => $request->title,
            'unit' => $request->unit,
         ]);
         return redirect()->back()->with('OK', 'Data berhasil diubah');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SettingJobRequest  $settingJobRequest
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     {
         $data = SettingJobRequest::findOrFail($id)->delete();

         return redirect()->back()->with('OK', 'Data berhasil dihapus');
     }
}
