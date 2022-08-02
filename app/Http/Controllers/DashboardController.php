<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;

class DashboardController extends Controller
{
    public function index()
    {
        $data['title'] = 'Beranda';
        return view('dashboard.index', $data);
    }
    
    public function edit() 
    {
        $data['title'] = 'Edit Beranda';
        $data['about'] = About::orderBy('id')->first();
        
        return view('dashboard.edit', $data);
    }
    
    public function update(Request $request)
    {
        $data = About::orderBy('id')->first();
        $data->update([
           'description' => $request->description 
        ]);
        
        return redirect()->route('dashboard.index')->with('OK', 'Data berhasil diubah.');
    }
}
