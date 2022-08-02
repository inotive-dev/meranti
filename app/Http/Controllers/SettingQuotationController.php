<?php

namespace App\Http\Controllers;

use App\Models\SettingQuotation;
use Illuminate\Http\Request;

class SettingQuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['title'] = 'Setting Quotation';
      $data['setting_quotation'] = SettingQuotation::orderBy('id')->get();

      return view('dashboard.setting.quotation.index', $data);
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
      SettingQuotation::create([
        'title' => $request->title,
      ]);

      return redirect()->back()->with('OK', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SettingQuotation  $settingQuotation
     * @return \Illuminate\Http\Response
     */
    public function show(SettingQuotation $settingQuotation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SettingQuotation  $settingQuotation
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
     {
         $data = SettingQuotation::findOrFail($id);

         return $data;
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SettingQuotation  $settingQuotation
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
     {
         $data = SettingQuotation::findOrFail($id);

         $data->update([
            'title' => $request->title,
         ]);
         return redirect()->back()->with('OK', 'Data berhasil diubah');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SettingQuotation  $settingQuotation
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     {
         $data = SettingQuotation::findOrFail($id)->delete();

         return redirect()->back()->with('OK', 'Data berhasil dihapus');
     }
}
