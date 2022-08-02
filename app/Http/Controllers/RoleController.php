<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Hak Akses';
        $data['roles'] = Role::with('permissions')->paginate(10);
        
        return view('dashboard.role.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Hak Akses';
        
        return view('dashboard.role.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::create([
            'name' => $request->name
        ]);
        
        if(isset($request->permission_name))
        {
            $permissions = [];
            foreach($request->permission_name as $key => $permissionName)
            {
                $permission = [
                    'role_id' => $role->id,
                    'permission_name' => $permissionName,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                array_push($permissions, $permission);
            }
            
            Permission::insert($permissions);
        }
        
        return redirect()->back()->with('OK', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $data['title'] = 'Edit Hak Akses';
        
        $role = Role::with('permissions')->where('id', $id)->first();
        if($request->data == 'true')
        {
            return $role;
        }
        $data['role'] = $role;
        
        return view('dashboard.role.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        
        $role->update([
            'name' => $request->name
        ]);
        
        Permission::where('role_id', $id)->delete();
        if(isset($request->permission_name))
        {
            $permissions = [];
            foreach($request->permission_name as $key => $permissionName)
            {
                $permission = [
                    'role_id' => $id,
                    'permission_name' => $permissionName,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                array_push($permissions, $permission);
            }
            
            Permission::insert($permissions);
        }
        
        return redirect()->back()->with('OK', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        
        return redirect()->back()->with('OK', 'Data berhasil dihapus');
    }
}
