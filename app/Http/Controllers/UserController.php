<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\UserRole;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $data['title'] = 'Pengguna';
        $data['users'] = User::orderBy('id')->get();
        return view('dashboard.user.index', $data);
    }
    
    public function create()
    {
        $data['title'] = "Tambah Pengguna";
        $data['roles'] = Role::orderBy('id')->get();
        
        return view('dashboard.user.create', $data);
    }

    public function store(UserRequest $request)
    {
        $user = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'position' => $request->position,
           'password' => bcrypt($request->password)
        ]);
        
        UserRole::create([
           'user_id' => $user->id,
           'role_id' => $request->role_id
        ]);

        return redirect()->route('dashboard.user.index')->with('OK', 'Data berhasil ditambah.');
    }

    public function edit($id)
    {
        $data['title'] = "Edit Pengguna";
        $data['user'] = User::findOrFail($id);
        $data['roles'] = Role::orderBy('id')->get();
        
        return view('dashboard.user.edit', $data);
    }

    public function update(UserRequest $request, $id)
    {
        $data = User::findOrFail($id);
        $data->update([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
        ]);
        
        $data->user_role->update([
            'role_id' => $request->role_id
        ]);

        if($request->password != null)
        {
            $data->update([
                'password' => bcrypt($request->password)
            ]);
        }

        return redirect()->route('dashboard.user.index')->with('OK', 'Data berhasil diubah.');
    }

    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('OK', 'Data berhasil dihapus.');
    }
}
