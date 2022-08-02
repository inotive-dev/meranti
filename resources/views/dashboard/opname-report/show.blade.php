@extends('layouts.master')

@section('style')
  <style>
  .text-justify{
    text-align: justify;
  }
  /*.table>thead>tr>th, .table>tbody>tr:not(.no-bg)>td{*/
  /*  padding: 30px !important;*/
  /*}*/
  /*.table>thead>tr>th, .table>tbody>tr>td{*/
  /*  border-bottom: none !important;*/
  /*}*/
  /*.table>tbody>tr:not(.no-bg)>td{*/
  /*  background: #FFFFFF !important;*/
  /*}*/
  /*.table>tbody>tr:not(.no-bg){*/
  /*  box-shadow: 0px 4px 9px rgba(194, 194, 194, 0.25);*/
  /*}*/

  /*.table>tbody>tr:not(.no-bg)>td:first-child{*/
  /*  border-top-left-radius: 10px;*/
  /*  border-bottom-left-radius: 10px;*/
  /*}*/
  /*.table>tbody>tr:not(.no-bg)>td:last-child{*/
  /*  border-top-right-radius: 10px;*/
  /*  border-bottom-right-radius: 10px;*/
  /*}*/
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
      <h3>Opname Report Item</h3>
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
          <a href="{{ route('dashboard.opname-report.index', ['id' => $quotation->job_request->project_id]) }}">Detail</a>
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
                        <th class="text-center">Verifikasi by Produksi</th>
                        @if(in_array('verification_ppic_opname_report_item', $userPermissions))
                            <th class="text-center">Verifikasi by PPIC</th>
                        @endif
                        @if(in_array('verification_ppic_opname_report_item', $userPermissions) || in_array('verification_production_opname_report_item', $userPermissions))
                            <th class="text-center">Aksi</th>
                        @endif
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
                                    <th>{{ $quotation_item->volume }}</th>
                                    <th>{{ $quotation_item->verification_production }}</th>
                                    @if(in_array('verification_ppic_opname_report_item', $userPermissions))
                                        <th>{{ $quotation_item->verification_ppic }}</th>
                                    @endif
                                    @if(in_array('verification_ppic_opname_report_item', $userPermissions) || in_array('verification_production_opname_report_item', $userPermissions))
                                        <th>
                                            @if(in_array('verification_production_opname_report_item', $userPermissions))
                                                <a href="javascript:;" class="btn btn-outline-primary btn-verification-production" data-id="{{ $quotation_item->id }}">
                                                  <i data-feather="edit" class="align-middle"></i>
                                                  <span class="ms-1 align-middle">Edit</span>
                                                </a>
                                            @endif
                                            @if(in_array('verification_ppic_opname_report_item', $userPermissions))
                                                <a href="javascript:;" class="btn btn-outline-primary btn-verification-ppic" data-id="{{ $quotation_item->id }}">
                                                  <i data-feather="edit" class="align-middle"></i>
                                                  <span class="ms-1 align-middle">Edit</span>
                                                </a>
                                            @endif
                                        </th>
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
                                        <th>{{ $quotation_item->volume }}</th>
                                        <th>{{ $quotation_item->verification_production }}</th>
                                        @if(in_array('verification_ppic_opname_report_item', $userPermissions))
                                            <th>{{ $quotation_item->verification_ppic }}</th>
                                        @endif
                                        @if(in_array('verification_ppic_opname_report_item', $userPermissions) || in_array('verification_production_opname_report_item', $userPermissions))
                                            <th>
                                                @if(in_array('verification_production_opname_report_item', $userPermissions))
                                                    <a href="javascript:;" class="btn btn-outline-primary btn-verification-production" data-id="{{ $quotation_item->id }}">
                                                      <i data-feather="edit" class="align-middle"></i>
                                                      <span class="ms-1 align-middle">Edit</span>
                                                    </a>
                                                @endif
                                                @if(in_array('verification_ppic_opname_report_item', $userPermissions))
                                                    <a href="javascript:;" class="btn btn-outline-primary btn-verification-ppic" data-id="{{ $quotation_item->id }}">
                                                      <i data-feather="edit" class="align-middle"></i>
                                                      <span class="ms-1 align-middle">Edit</span>
                                                    </a>
                                                @endif
                                            </th>
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
                                        <td>{{ $quotation_item_child->volume }}</td>
                                        <th>{{ $quotation_item_child->verification_production }}</th>
                                        @if(in_array('verification_ppic_opname_report_item', $userPermissions))
                                            <th>{{ $quotation_item_child->verification_ppic }}</th>
                                        @endif
                                        @if(in_array('verification_ppic_opname_report_item', $userPermissions) || in_array('verification_production_opname_report_item', $userPermissions))
                                            <th>
                                                @if(in_array('verification_production_opname_report_item', $userPermissions))
                                                    <a href="javascript:;" class="btn btn-outline-primary btn-verification-production" data-id="{{ $quotation_item_child->id }}">
                                                      <i data-feather="edit" class="align-middle"></i>
                                                      <span class="ms-1 align-middle">Edit</span>
                                                    </a>
                                                @endif
                                                @if(in_array('verification_ppic_opname_report_item', $userPermissions))
                                                    <a href="javascript:;" class="btn btn-outline-primary btn-verification-ppic" data-id="{{ $quotation_item_child->id }}">
                                                      <i data-feather="edit" class="align-middle"></i>
                                                      <span class="ms-1 align-middle">Edit</span>
                                                    </a>
                                                @endif
                                            </th>
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
                                            <td>{{ $quotation_item_child->volume }}</td>
                                            <th>{{ $quotation_item_child->verification_production }}</th>
                                            @if(in_array('verification_ppic_opname_report_item', $userPermissions))
                                                <th>{{ $quotation_item_child->verification_ppic }}</th>
                                            @endif
                                            @if(in_array('verification_ppic_opname_report_item', $userPermissions) || in_array('verification_production_opname_report_item', $userPermissions))
                                                <th>
                                                    @if(in_array('verification_production_opname_report_item', $userPermissions))
                                                        <a href="javascript:;" class="btn btn-outline-primary btn-verification-production" data-id="{{ $quotation_item_child->id }}">
                                                          <i data-feather="edit" class="align-middle"></i>
                                                          <span class="ms-1 align-middle">Edit</span>
                                                        </a>
                                                    @endif
                                                    @if(in_array('verification_ppic_opname_report_item', $userPermissions))
                                                        <a href="javascript:;" class="btn btn-outline-primary btn-verification-ppic" data-id="{{ $quotation_item_child->id }}">
                                                          <i data-feather="edit" class="align-middle"></i>
                                                          <span class="ms-1 align-middle">Edit</span>
                                                        </a>
                                                    @endif
                                                </th>
                                            @endif
                                        </tr>
                                    @endif
                                @endif
                                @foreach($quotation_item_child->quotation_item_childs as $key3 => $quotation_item_sub_child)
                                    @if(count($quotation_item_child->quotation_item_childs) > 0)
                                        <tr>
                                            <td class="pe-0">
                                            </td>
                                            <td>
                                                <ul class="sub3">
                                                    <li>{{ $quotation_item_sub_child->name }}</li>
                                                </ul>
                                            </td>
                                            <td>{{ $quotation_item_sub_child->volume }}</td>
                                            <th>{{ $quotation_item_sub_child->verification_production }}</th>
                                            @if(in_array('verification_ppic_opname_report_item', $userPermissions))
                                                <th>{{ $quotation_item_sub_child->verification_ppic }}</th>
                                            @endif
                                            @if(in_array('verification_ppic_opname_report_item', $userPermissions) || in_array('verification_production_opname_report_item', $userPermissions))
                                                <th>
                                                    @if(in_array('verification_production_opname_report_item', $userPermissions))
                                                        <a href="javascript:;" class="btn btn-outline-primary btn-verification-production" data-id="{{ $quotation_item_sub_child->id }}">
                                                          <i data-feather="edit" class="align-middle"></i>
                                                          <span class="ms-1 align-middle">Edit</span>
                                                        </a>
                                                    @endif
                                                    @if(in_array('verification_ppic_opname_report_item', $userPermissions))
                                                        <a href="javascript:;" class="btn btn-outline-primary btn-verification-ppic" data-id="{{ $quotation_item_sub_child->id }}">
                                                          <i data-feather="edit" class="align-middle"></i>
                                                          <span class="ms-1 align-middle">Edit</span>
                                                        </a>
                                                    @endif
                                                </th>
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
                                                <td>{{ $quotation_item_sub_child->volume }}</td>
                                                <th>{{ $quotation_item_sub_child->verification_production }}</th>
                                                @if(in_array('verification_ppic_opname_report_item', $userPermissions))
                                                    <th>{{ $quotation_item_sub_child->verification_ppic }}</th>
                                                @endif
                                                @if(in_array('verification_ppic_opname_report_item', $userPermissions) || in_array('verification_production_opname_report_item', $userPermissions))
                                                    <th>
                                                        @if(in_array('verification_production_opname_report_item', $userPermissions))
                                                            <a href="javascript:;" class="btn btn-outline-primary btn-verification-production" data-id="{{ $quotation_item_sub_child->id }}">
                                                              <i data-feather="edit" class="align-middle"></i>
                                                              <span class="ms-1 align-middle">Edit</span>
                                                            </a>
                                                        @endif
                                                        @if(in_array('verification_ppic_opname_report_item', $userPermissions))
                                                            <a href="javascript:;" class="btn btn-outline-primary btn-verification-ppic" data-id="{{ $quotation_item_sub_child->id }}">
                                                              <i data-feather="edit" class="align-middle"></i>
                                                              <span class="ms-1 align-middle">Edit</span>
                                                            </a>
                                                        @endif
                                                    </th>
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

    <div class="modal fade" tabindex="-1" role="dialog" id="edit-verification-production-modal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Verifikasi by Produksi</h5>
              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>
            <form action="" method="POST" id="edit-verification-production-form" enctype="multipart/form-data">
              @csrf
              @method("PUT")
              <div class="modal-body">
                <input type="hidden" name="position" value="production">
                <div class="form-group">
                  <label>Verifikasi <span class="text-danger">*</span></label>
                  <input type="text" name="verification" class="form-control" id="edit-verification" placeholder="Masukkan data..." required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-light font-weight-bolder" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary font-weight-bolder">Simpan</button>
              </div>
            </form>
          </div>
        </div>
    </div>
    
    <div class="modal fade" tabindex="-1" role="dialog" id="edit-verification-ppic-modal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Verifikasi by PPIC</h5>
              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>
            <form action="" method="POST" id="edit-verification-ppic-form" enctype="multipart/form-data">
              @csrf
              @method("PUT")
              <div class="modal-body">
                <input type="hidden" name="position" value="ppic">
                <div class="form-group">
                  <label>Verifikasi <span class="text-danger">*</span></label>
                  <input type="text" name="verification" class="form-control" id="edit-verification" placeholder="Masukkan data..." required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-light font-weight-bolder" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary font-weight-bolder">Simpan</button>
              </div>
            </form>
          </div>
        </div>
    </div>
@endsection

@section('script')
  <script>
    // verif 1 events
    $(document).on("click", ".btn-verification-production", function()
    {
      var id = $(this).data('id');
      $("#edit-verification-production-form").trigger("reset");
      $("#edit-verification-production-form").attr("action", "{{ route('dashboard.opname-report.index') }}/" + id);
      $.ajax({
        method: "GET",
        url: "{{ route('dashboard.opname-report.index') }}/" + id + "/edit?_token={{ csrf_token() }}"
      }).done(function(response)
      {
        $("#edit-verification").val(response.verification_production);
        $("#edit-verification-production-modal").modal('show');
      });
    });
    
    $(document).on("click", ".btn-verification-ppic", function()
    {
      var id = $(this).data('id');
      $("#edit-verification-ppic-form").trigger("reset");
      $("#edit-verification-ppic-form").attr("action", "{{ route('dashboard.opname-report.index') }}/" + id);
      $.ajax({
        method: "GET",
        url: "{{ route('dashboard.opname-report.index') }}/" + id + "/edit?_token={{ csrf_token() }}"
      }).done(function(response)
      {
        $("#edit-verification").val(response.verification_production);
        $("#edit-verification-ppic-modal").modal('show');
      });
    });
  </script>
@endsection
