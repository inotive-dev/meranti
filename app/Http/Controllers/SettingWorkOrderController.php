<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkOrderRequest;
use App\Models\SettingWorkOrder;
use Illuminate\Http\Request;

class SettingWorkOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Setting Work Order';
        $data['setting'] = SettingWorkOrder::first();
        
        return view('dashboard.setting.work-order.index', $data);
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
    public function store(WorkOrderRequest $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SettingWorkOrder  $settingWorkOrder
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SettingWorkOrder  $settingWorkOrder
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = SettingWorkOrder::findOrFail($id);
        
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SettingWorkOrder  $settingWorkOrder
     * @return \Illuminate\Http\Response
     */
    public function update(WorkOrderRequest $request, $id)
    {
        $data = SettingWorkOrder::first();
        if(!empty($data))
        {
            $data->update([
                'title' => $request->title,
            ]);
        }else{
            SettingWorkOrder::create([
               'title' => $request->title,
            ]);
        }

        return redirect()->route('dashboard.setting.work-order.index')->with('OK', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SettingWorkOrder  $settingWorkOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = SettingWorkOrder::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('OK', 'Data berhasil dihapus.');
    }
}
