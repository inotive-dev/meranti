<?php

namespace App\Http\Controllers;

use App\Models\SettingLapdoc;
use Illuminate\Http\Request;

class SettingLapdocController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data['title'] = 'Setting Quotation';
    $data['setting'] = SettingLapdoc::first();

    return view('dashboard.setting.lapdoc.index', $data);
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
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\SettingLapdoc  $SettingLapdoc
   * @return \Illuminate\Http\Response
   */
  public function show(SettingLapdoc $SettingLapdoc)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\SettingLapdoc  $SettingLapdoc
   * @return \Illuminate\Http\Response
   */
   public function edit($id)
   {
       $data = SettingLapdoc::findOrFail($id);

       return $data;
   }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\SettingLapdoc  $SettingLapdoc
   * @return \Illuminate\Http\Response
   */
   public function update(Request $request, $id)
   {
       $data = SettingLapdoc::first();
       if(!empty($data))
       {
          $data->update([
              'title' => $request->title,
          ]);
       }else
       {
          SettingLapdoc::create([
              'title' => $request->title,
          ]);
       }
       return redirect()->back()->with('OK', 'Data berhasil diubah');
   }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\SettingLapdoc  $SettingLapdoc
   * @return \Illuminate\Http\Response
   */
   public function destroy($id)
   {
       $data = SettingLapdoc::findOrFail($id)->delete();

       return redirect()->back()->with('OK', 'Data berhasil dihapus');
   }
}
