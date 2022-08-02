<?php

namespace App\Http\Controllers;

use App\Models\SettingSNote;
use Illuminate\Http\Request;

class SettingSNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['title'] = 'Setting Quotation';
      $data['setting'] = SettingSNote::first();

      return view('dashboard.setting.s-note.index', $data);
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
     * @param  \App\Models\SettingSNote  $SettingSNote
     * @return \Illuminate\Http\Response
     */
    public function show(SettingSNote $SettingSNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SettingSNote  $SettingSNote
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
     {
         $data = SettingSNote::findOrFail($id);

         return $data;
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SettingSNote  $SettingSNote
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
     {
         $data = SettingSNote::first();
         if(!empty($data))
         {
            $data->update([
                'title' => $request->title,
            ]);
         }else
         {
            SettingSNote::create([
                'title' => $request->title,
            ]);
         }
         return redirect()->back()->with('OK', 'Data berhasil diubah');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SettingSNote  $SettingSNote
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     {
         $data = SettingSNote::findOrFail($id)->delete();

         return redirect()->back()->with('OK', 'Data berhasil dihapus');
     }
}
