@extends('layouts.master')

@section('style')
  <style>
  .text-justify{
    text-align: justify;
  }
    .sub3 {
        list-style: none; /* Remove list bullets */
        padding: 0;
        margin: 0;
    }
    
    .sub3 li {
        padding-left: 16px;
    }
    
    .sub3 li::before {
        content: "-"; /* Insert content that looks like bullets */
        padding-right: 8px;
    }
    .feather-small{
        height: 14px;
        width: 14px;
    }
  </style>
@endsection

@section('breadcrumb')
  <div class="row">
    <div class="col-6">
      <h3>S-Note Item</h3>
    </div>
    <div class="col-6">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          Beranda
        </li>
        <li class="breadcrumb-item">
          <a href="{{ route('dashboard.project.index') }}">Project</a>
        </li>
        <li class="breadcrumb-item">
          <a href="{{ route('dashboard.s-note.index', ['id' => $quotation->job_request->project_id]) }}">Detail</a>
        </li>
        <li class="breadcrumb-item active">
          Item
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
                                <td class="text-start text-nowrap" style="width: 1%">Nomor</td>
                                <td class="px-3" style="width: 1%">:</td>
                                <td class="text-start">{{ $quotation->job_request->number ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-start text-nowrap" style="width: 1%">Revisi</td>
                                <td class="px-3" style="width: 1%">:</td>
                                <td class="text-start">{{ $quotation->job_request->revision ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-start text-nowrap" style="width: 1%">Owner</td>
                                <td class="px-3" style="width: 1%">:</td>
                                <td class="text-start">{{ $quotation->job_request->project->client->name ?? '-' }}</td>
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
          <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Item</th>
                        <th class="text-center">Volume</th>
                        <th class="text-center">Remark</th>
                    </thead>
                    <tbody>
                        @foreach($quotation_items as $key => $quotation_item)
                            @if(count($quotation_item->quotation_item_childs) > 0)
                                    <tr>
                                        <th>
                                            <ol style="list-style-type: upper-roman;" start="{{ $key + 1 }}">
                                                <li></li>
                                            </ol>
                                        </th>
                                        <th>{{ $quotation_item->name }}</th>
                                        <th>{{ $quotation_item->verification_ppic }} {{ $quotation_item->job_request_item->unit }}</th>
                                        @if($quotation_item->verification_production != null && $quotation_item->verification_production == $quotation_item->verification_ppic)
                                            <th>Selesai 100%</th>
                                        @else
                                            <th></th>
                                        @endif
                                    </tr>
                            @else
                                @if($quotation_item->job_request_item->remarks == 1)
                                        <tr>
                                            <th>
                                                <ol style="list-style-type: upper-roman;" start="{{ $key + 1 }}">
                                                    <li></li>
                                                </ol>
                                            </th>
                                            <th>{{ $quotation_item->name }}</th>
                                            <th>{{ $quotation_item->verification_ppic }} {{ $quotation_item->job_request_item->unit }}</th>
                                            @if($quotation_item->verification_production != null && $quotation_item->verification_production == $quotation_item->verification_ppic)
                                                <th>Selesai 100%</th>
                                            @else
                                                <th></th>
                                            @endif
                                        </tr>
                                @endif
                            @endif
                            @foreach($quotation_item->quotation_item_childs as $key2 => $quotation_item_child)
                                @if(count($quotation_item_child->quotation_item_childs) > 0)
                                        <tr>
                                            <td class="pe-0">
                                                <ol class="text-right pe-0 me-0" style="list-style-type: lower-alpha;" start="{{ $key2 + 1 }}">
                                                    <li style="width: 0px"></li>
                                                </ol>
                                            </td>
                                            <td>{{ $quotation_item_child->name }}</td>
                                            <td>{{ $quotation_item_child->verification_ppic }} {{ $quotation_item_child->job_request_item->unit }}</td>
                                            @if($quotation_item_child->verification_production != null && $quotation_item_child->verification_production == $quotation_item_child->verification_ppic)
                                                <th>Selesai 100%</th>
                                            @else
                                                <th></th>
                                            @endif
                                        </tr>
                                @else
                                    @if($quotation_item_child->job_request_item->remarks == 1)
                                        <tr>
                                            <td class="pe-0">
                                                <ol class="text-right pe-0 me-0" style="list-style-type: lower-alpha;" start="{{ $key2 + 1 }}">
                                                    <li style="width: 0px"></li>
                                                </ol>
                                            </td>
                                            <td>{{ $quotation_item_child->name }}</td>
                                            <td>{{ $quotation_item_child->verification_ppic }} {{ $quotation_item_child->job_request_item->unit }}</td>
                                            @if($quotation_item_child->verification_production != null && $quotation_item_child->verification_production == $quotation_item_child->verification_ppic)
                                                <th>Selesai 100%</th>
                                            @else
                                                <th></th>
                                            @endif
                                        </tr>
                                    @endif
                                @endif
                                @foreach($quotation_item_child->quotation_item_childs as $key3 => $quotation_item_sub_child)
                                    @if(count($quotation_item_sub_child->quotation_item_childs) > 0)
                                        <tr>
                                            <td class="pe-0">
                                            </td>
                                            <td>
                                                <ul class="sub3">
                                                    <li>{{ $quotation_item_sub_child->name }}</li>
                                                </ul>
                                            </td>
                                            <td>{{ $quotation_item_sub_child->verification_ppic }} {{ $quotation_item_sub_child->job_request_item->unit }}</td>
                                            @if($quotation_item_sub_child->verification_production != null && $quotation_item_sub_child->verification_production == $quotation_item_sub_child->verification_ppic)
                                                <th>Selesai 100%</th>
                                            @else
                                                <th></th>
                                            @endif
                                        </tr>
                                    @else
                                        @if($quotation_item_sub_child->job_request_item->remarks == 1)
                                            <tr>
                                                <td class="pe-0">
                                                </td>
                                                <td>
                                                    <ul class="sub3">
                                                        <li>{{ $quotation_item_sub_child->name }}</li>
                                                    </ul>
                                                </td>
                                                <td>{{ $quotation_item_sub_child->verification_ppic }} {{ $quotation_item_sub_child->job_request_item->unit }}</td>
                                                @if($quotation_item_sub_child->verification_production != null && $quotation_item_sub_child->verification_production == $quotation_item_sub_child->verification_ppic)
                                                    <th>Selesai 100%</th>
                                                @else
                                                    <th></th>
                                                @endif
                                            </tr>                                    
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
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
