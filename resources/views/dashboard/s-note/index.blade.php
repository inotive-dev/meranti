@extends('layouts.master')

@section('style')
  <style>
  .text-justify{
    text-align: justify;
  }
  .table>thead>tr>th, .table>tbody>tr:not(.no-bg)>td{
    padding: 30px !important;
  }
  .table>thead>tr>th, .table>tbody>tr>td{
    border-bottom: none !important;
  }
  .table>tbody>tr:not(.no-bg)>td{
    background: #FFFFFF !important;
  }
  .table>tbody>tr:not(.no-bg){
    box-shadow: 0px 4px 9px rgba(194, 194, 194, 0.25);
  }

  .table>tbody>tr:not(.no-bg)>td:first-child{
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
  }
  .table>tbody>tr:not(.no-bg)>td:last-child{
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
  }
  </style>
@endsection

@section('breadcrumb')
  <div class="row">
    <div class="col-6">
      <h3>Detail S-Note</h3>
    </div>
    <div class="col-6">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          Beranda
        </li>
        <li class="breadcrumb-item">
          <a href="{{ route('dashboard.project.index') }}">Project</a>
        </li>
        <li class="breadcrumb-item active">
          Detail
        </li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
@php
    $userPermissions = [];
    if(Auth::user()->user_role != null)
    {
      $userPermissions = Auth::user()->user_role->role->permissions->pluck('permission_name')->toArray();
    }
@endphp
  <div class="container">
    <div class="row">
      <div class="col-12 mb-3 text-end">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="w-100">
                            <tr>
                                <td class="text-start text-nowrap" style="width: 1%">Owner</td>
                                <td class="px-3" style="width: 1%">:</td>
                                <td class="text-start">{{ $project->client->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-start text-nowrap" style="width: 1%">Nama Project</td>
                                <td class="px-3" style="width: 1%">:</td>
                                <td class="text-start">{{ $project->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-start text-nowrap" style="width: 1%">Length</td>
                                <td class="px-3" style="width: 1%">:</td>
                                <td class="text-start">{{ $project->length ?? '-' }} meter</td>
                            </tr>
                            <tr>
                                <td class="text-start text-nowrap" style="width: 1%">Breadth</td>
                                <td class="px-3" style="width: 1%">:</td>
                                <td class="text-start">{{ $project->breadth ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-start text-nowrap" style="width: 1%">Depth</td>
                                <td class="px-3" style="width: 1%">:</td>
                                <td class="text-start">{{ $project->depth ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-12 px-3">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Nomor Job Request</th>
                <th class="">Revisi</th>
                <th class="">Referensi</th>
                <th>Status</th>
                @if(in_array('read_opname_report_item', $userPermissions))
                    <th class="text-nowrap text-end" style="width: 10%">Aksi</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @php
                $no = 1;  
              @endphp
              @foreach($quotations as $quotation)
                <tr>
                  <td class="align-middle">{{ $quotation->job_request->number ?? '-' }}</td>
                  <td class="align-middle">{{ $quotation->job_request->revision ?? '-' }}</td>
                  <td class="align-middle">{{ $quotation->job_request->reference ?? '-' }}</td>
                  <td class="align-middle">{{ $quotation->status ?? '-' }}</td>
                  @if(in_array('read_opname_report_item', $userPermissions))
                      <td class="text-nowrap">
                        <a href="{{ route('dashboard.s-note.show', $quotation->id) }}" class="btn btn-outline-info" data-id="{{ $quotation->id }}">
                          <i data-feather="edit" class="align-middle"></i>
                          <span class="ms-1 align-middle">Item</span>
                        </a>
                      </td>
                  @endif
                </tr>
                <tr class="no-bg">
                  <td colspan="4"></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!--end: Datatable-->
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>

  </script>
@endsection
