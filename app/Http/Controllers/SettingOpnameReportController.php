<?php

namespace App\Http\Controllers;

use App\Http\Requests\OpnameReportRequest;
use App\Models\SettingOpnameReport;
use Illuminate\Http\Request;

class SettingOpnameReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Setting Opname Report';
        $data['setting'] = SettingOpnameReport::first();
        
        return view('dashboard.setting.opname-report.index', $data);
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
    public function store(OpnameReportRequest $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SettingOpnameReport  $settingOpnameReport
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SettingOpnameReport  $settingOpnameReport
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SettingOpnameReport  $settingOpnameReport
     * @return \Illuminate\Http\Response
     */
    public function update(OpnameReportRequest $request, $id)
    {
        $data = SettingOpnameReport::first();
        if(!empty($data))
        {
            $data->update([
                'title' => $request->title,
            ]);
        }else{
            SettingOpnameReport::create([
               'title' => $request->title,
            ]);
        }

        return redirect()->route('dashboard.setting.opname-report.index')->with('OK', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SettingOpnameReport  $settingOpnameReport
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = SettingOpnameReport::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('OK', 'Data berhasil dihapus.');
    }
}
