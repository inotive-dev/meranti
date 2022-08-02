<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use Illuminate\Http\Request;
use App\Models\UserRole;
use App\Models\Client;
use App\Models\User;
use App\Models\Role;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Client';
        $data['clients'] = Client::orderBy('id')->get();
        
        return view('dashboard.client.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Client';
        $data['roles'] = Role::orderBy('id')->get();
        
        return view('dashboard.client.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $filePath = null;
        if ($request->hasFile('file')) {
          $save = $request->file('file')->store('public/files');
          $filename = $request->file('file')->hashName();
          $filePath = '/storage/files/' . $filename;
        }
        
        $user = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'position' => '-',
           'password' => bcrypt($request->password)
        ]);
        
        UserRole::create([
           'user_id' => $user->id,
           'role_id' => $request->role_id
        ]);
        
        Client::create([
          'user_id' => $user->id,
          'name' => $request->name,
          'phone' => $request->phone,
          'email' => $request->email,
          'address' => $request->address,
          'logo' => $filePath,
        ]);
        
        return redirect()->route('dashboard.client.index')->with('OK', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Edit Client';
        $data['client'] = Client::findOrFail($id);
        
        return view('dashboard.client.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, $id)
    {
        $data = Client::findOrFail($id);
        
        $filePath = $data->logo;
        if ($request->hasFile('file')) {
          $save = $request->file('file')->store('public/files');
          $filename = $request->file('file')->hashName();
          $filePath = '/storage/files/' . $filename;
        }
        
        $data->update([
          'name' => $request->name,
          'phone' => $request->phone,
          'email' => $request->email,
          'address' => $request->address,
          'logo' => $filePath,
        ]);
        
        return redirect()->route('dashboard.client.index')->with('OK', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Client::findOrFail($id);
        $data->delete();
        
        return redirect()->back()->with('OK', 'Data berhasil dihapus');
    }
}
