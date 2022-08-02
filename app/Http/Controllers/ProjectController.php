<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\ProjectClient;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Client;
use Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = [];
        if(Auth::user()->user_role != null)
        {
          $permissions = Auth::user()->user_role->role->permissions->pluck('permission_name')->toArray();
        }
    
        if(in_array('read_all_project', $permissions))
        {
            $data['projects'] = Project::orderBy('id')->get();
        } else {
            if(Auth::user()->client != null)
            {
                $data['projects'] = Project::where('client_id', Auth::user()->client->id)->orderBy('id')->get();
            } else {
                $data['projects'] = [];
            }
        }
        $data['title'] = 'Proyek';
        
        return view('dashboard.project.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Tambah Proyek";
        $data['clients'] = Client::orderBy('name')->get();
        
        return view('dashboard.project.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $project = Project::create([
           'client_id' => $request->client_id,
           'name' => $request->name,
           'length' => $request->length,
           'breadth' => $request->breadth,
           'depth' => $request->depth,
           'klass' => $request->klass,
           'description' => $request->description,
           'status' => $request->status,
        ]);

        return redirect()->route('dashboard.project.index')->with('OK', 'Data berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = "Edit Proyek";
        $data['project'] = Project::findOrFail($id);
        $data['clients'] = Client::orderBy('name')->get();
        
        return view('dashboard.project.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Project::findOrFail($id);
        $data->update([
            'client_id' => $request->client_id,
            'name' => $request->name,
            'length' => $request->length,
            'breadth' => $request->breadth,
            'depth' => $request->depth,
            'klass' => $request->klass,
            'description' => $request->description,
           'status' => $request->status,
        ]);
        
        return redirect()->route('dashboard.project.index')->with('OK', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Project::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('OK', 'Data berhasil dihapus.');
    }
}
