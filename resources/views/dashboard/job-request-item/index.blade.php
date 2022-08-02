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
      <h3>Job Request</h3>
    </div>
    <div class="col-6">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          Beranda
        </li>
        <li class="breadcrumb-item">
          <a href="{{ route('dashboard.job-request.index', ['project_id' => $job_request->project_id]) }}">Job Request</a>
        </li>
        <li class="breadcrumb-item active">
          Job Request Detail
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
                                <td class="text-start">{{ $job_request->number ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-start text-nowrap" style="width: 1%">Revisi</td>
                                <td class="px-3" style="width: 1%">:</td>
                                <td class="text-start">{{ $job_request->revision ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-start text-nowrap" style="width: 1%">Project</td>
                                <td class="px-3" style="width: 1%">:</td>
                                <td class="text-start">{{ $job_request->project->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-start text-nowrap" style="width: 1%">Owner</td>
                                <td class="px-3" style="width: 1%">:</td>
                                <td class="text-start">{{ $job_request->project->client->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-start text-nowrap" style="width: 1%">Referensi</td>
                                <td class="px-3" style="width: 1%">:</td>
                                <td class="text-start">{{ $job_request->reference ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 mb-3 text-end">
          @if(in_array('create_job_request_item', $userPermissions))
              @if($job_request->verification == 0)
                <button class="btn btn-primary btn-create">
                  <span class="ms-1 align-middle">
                    <i data-feather="plus" class="align-middle"></i>
                    Tambah
                  </span>
                </button>
              @endif
          @endif
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-12 px-3">
          <form method="POST" action="{{ route('dashboard.job-request-item.verification') }}">
              @csrf
              <input type="hidden" name="id" value="{{ $job_request->id }}">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Item</th>
                            <th class="text-center">Volume</th>
                            <th class="text-center">Remarks</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">
                                @if(in_array('verification_job_request_item', $userPermissions))
                                <input class="checkbox_animated check-all"
                                    type="checkbox" data-child=".item-child">
                                @endif
                                Verifikasi
                            </th>
                            @if(in_array('update_job_request_item', $userPermissions) || in_array('delete_job_request_item', $userPermissions))
                                <th class="text-center" width="1%">Aksi</th>
                            @endif
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($job_request_items as $key => $job_request_item)
                                <tr>
                                    <th>
                                        <ol style="list-style-type: upper-roman;" start="{{ $key + 1 }}">
                                            <li></li>
                                        </ol>
                                    </th>
                                    <th class="{{ $job_request_item->remarks == 2 ? 'bg-warning' : '' }}{{ $job_request_item->remarks == 3 ? 'bg-danger' : '' }}">{{ $job_request_item->name }}</th>
                                    <th>{{ $job_request_item->volume . ' ' . $job_request_item->unit }}</th>
                                    <th>{{ $job_request_item->remarks_reason }}</th>
                                    <th>{{ $job_request_item->status }}</th>
                                    <th class="text-center">
                                        @if($job_request_item->verification == 0)
                                            @if(in_array('verification_job_request_item', $userPermissions))
                                                @if(count($job_request_item->job_request_item_childs) > 0)
                                                    <input class="checkbox_animated item-child check-all" id="item-child" type="checkbox" data-child=".item-child-{{ $job_request_item->id }}">
                                                @else
                                                    <input class="checkbox_animated item-child check-all" id="item-child" type="checkbox" name="job_request_id[]" value="{{ $job_request_item->id }}" data-child=".item-child-{{ $job_request_item->id }}">
                                                @endif
                                            @endif
                                        @else
                                            <input class="checkbox_animated" id="item-child" type="checkbox" checked disabled>
                                        @endif
                                    </th>
                                    @if(in_array('update_job_request_item', $userPermissions) || in_array('delete_job_request_item', $userPermissions))
                                        <th class="text-nowrap">
                                            @if($job_request->verification == 0)
                                                <div class="btn btn-group btn-group-sm">
                                                    @if(in_array('update_job_request_item', $userPermissions))
                                                        <button type="button" class="btn btn-outline-primary btn-edit" value="{{ $job_request_item->id }}" data-has-child="{{ count($job_request_item->job_request_item_childs) > 0 ? 1 : 0 }}">
                                                            <i data-feather="edit" class="align-middle feather-small"></i>
                                                        </button>
                                                    @endif
                                                    @if(in_array('delete_job_request_item', $userPermissions))
                                                        <button type="button" class="btn btn-outline-danger btn-delete" value="{{ $job_request_item->id }}">
                                                            <i data-feather="trash" class="align-middle feather-small"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            @else
                                                @if($job_request_item->quotation_item != null)
                                                    @if($job_request_item->quotation_item->verification_client == 1)
                                                        @if(in_array('update_job_request_item', $userPermissions))
                                                            <button type="button" class="btn btn-outline-primary btn-edit" value="{{ $job_request_sub_child->id }}" data-has-child="0">
                                                                <i data-feather="edit" class="align-middle feather-small"></i>
                                                            </button>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        </th>
                                    @endif
                                </tr>
                                @foreach($job_request_item->job_request_item_childs as $key2 => $job_request_child)
                                    <tr>
                                        <td class="pe-0">
                                            <ol class="text-right pe-0 me-0" style="list-style-type: lower-alpha;" start="{{ $key2 + 1 }}">
                                                <li style="width: 0px"></li>
                                            </ol>
                                        </td>
                                        <td class="{{ $job_request_child->remarks == 2 ? 'bg-warning' : '' }}{{ $job_request_child->remarks == 3 ? 'bg-danger' : '' }}">{{ $job_request_child->name }}</td>
                                        <td>{{ $job_request_child->volume . ' ' . $job_request_child->unit }}</td>
                                        <td>{{ $job_request_child->remarks_reason }}</td>
                                        <th>{{ $job_request_item->status }}</th>
                                        <td class="text-center">
                                            @if($job_request_child->verification == 0)
                                                @if(in_array('verification_job_request_item', $userPermissions))
                                                    @if(count($job_request_child->job_request_item_childs) > 0)
                                                        <input class="checkbox_animated item-child check-all item-child-{{ $job_request_item->id }}" id="item-child" type="checkbox" data-child=".item-child-{{ $job_request_child->id }}">
                                                    @else
                                                        <input class="checkbox_animated item-child check-all item-child-{{ $job_request_item->id }}" id="item-child" type="checkbox" name="job_request_id[]" value="{{ $job_request_child->id }}" data-child=".item-child-{{ $job_request_child->id }}">
                                                    @endif
                                                @endif
                                            @else
                                                <input class="checkbox_animated" id="item-child" type="checkbox" checked disabled>
                                            @endif
                                        </td>
                                        @if(in_array('update_job_request_item', $userPermissions) || in_array('delete_job_request_item', $userPermissions))
                                            <td>
                                                @if($job_request->verification == 0)
                                                    <div class="btn btn-group btn-group-sm">
                                                        @if(in_array('update_job_request_item', $userPermissions))
                                                            <button type="button" class="btn btn-outline-primary btn-edit" value="{{ $job_request_child->id }}" data-has-child="0">
                                                                <i data-feather="edit" class="align-middle feather-small"></i>
                                                            </button>
                                                        @endif
                                                        @if(in_array('delete_job_request_item', $userPermissions))
                                                            <button type="button" class="btn btn-outline-danger btn-delete" value="{{ $job_request_child->id }}">
                                                                <i data-feather="trash" class="align-middle feather-small"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                @else
                                                    @if($job_request_child->quotation_item != null)
                                                        @if($job_request_child->quotation_item->verification_client == 1)
                                                            @if(in_array('update_job_request_item', $userPermissions))
                                                                <button type="button" class="btn btn-outline-primary btn-edit" value="{{ $job_request_child->id }}" data-has-child="0">
                                                                    <i data-feather="edit" class="align-middle feather-small"></i>
                                                                </button>
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                    @foreach($job_request_child->job_request_item_childs as $key3 => $job_request_sub_child)
                                        <tr>
                                            <td class="pe-0">
                                            </td>
                                            <td> 
                                                <ul class="sub3 {{ $job_request_sub_child->remarks == 2 ? 'bg-warning' : '' }}{{ $job_request_sub_child->remarks == 3 ? 'bg-danger' : '' }}">
                                                    <li>{{ $job_request_sub_child->name }}</li>
                                                </ul>
                                            </td>
                                            <td>{{ $job_request_sub_child->volume . ' ' . $job_request_sub_child->unit }}</td>
                                            <td>{{ $job_request_sub_child->remarks_reason }}</td>
                                            <th>{{ $job_request_item->status }}</th>
                                            <td class="text-center">
                                                @if($job_request_sub_child->verification == 0)
                                                    @if(in_array('verification_job_request_item', $userPermissions))
                                                        <input class="checkbox_animated item-child item-child-{{ $job_request_item->id }} item-child-{{ $job_request_child->id }}" id="item-child" type="checkbox" name="job_request_id[]" value="{{ $job_request_sub_child->id }}">
                                                    @endif
                                                @else
                                                    <input class="checkbox_animated" id="item-child" type="checkbox" checked disabled>
                                                @endif
                                            </td>
                                            @if(in_array('update_job_request_item', $userPermissions) || in_array('delete_job_request_item', $userPermissions))
                                                <td>
                                                    @if($job_request->verification == 0)
                                                        <div class="btn btn-group btn-group-sm">
                                                            @if(in_array('update_job_request_item', $userPermissions))
                                                                <button type="button" class="btn btn-outline-primary btn-edit" value="{{ $job_request_sub_child->id }}" data-has-child="0">
                                                                    <i data-feather="edit" class="align-middle feather-small"></i>
                                                                </button>
                                                            @endif
                                                            @if(in_array('delete_job_request_item', $userPermissions))
                                                                <button type="button" class="btn btn-outline-danger btn-delete" value="{{ $job_request_sub_child->id }}">
                                                                    <i data-feather="trash" class="align-middle feather-small"></i>
                                                                </button>
                                                            @endif
                                                        </div>
                                                    @else
                                                        @if($job_request_sub_child->quotation_item != null)
                                                            @if($job_request_sub_child->quotation_item->verification_client == 1)
                                                                @if(in_array('update_job_request_item', $userPermissions))
                                                                    <button type="button" class="btn btn-outline-primary btn-edit" value="{{ $job_request_sub_child->id }}" data-has-child="0">
                                                                        <i data-feather="edit" class="align-middle feather-small"></i>
                                                                    </button>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tbody>
                        @if(in_array('verification_job_request_item', $userPermissions))
                            @if($job_request->verification == 0)
                                <tfooter>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th class="text-center">
                                        <button type="submit">Verifikasi</button>
                                    </th>
                                </tfooter>
                            @endif
                        @endif
                      </table>
                    </div>
                  </div>
                </div>
          </form>
        <!--end: Datatable-->
      </div>
    </div>
  </div>

  <div class="modal fade" role="dialog" id="create-modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Item Job Request</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
        </div>
        <form action="{{ route('dashboard.job-request-item.store') }}" method="POST" id="create-form" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <input type="hidden" name="job_request_id" value="{{ request()->job_request_id }}">
            <div class="mb-3">
                <label>Parent</label>
                <select name="job_request_item_id" class="select2 form-control" id="create-job-request-item-id">
                    <option></option>
                    @foreach($job_request_items as $key => $job_request_item)
                        <option value="{{ $job_request_item->id }}">{{ $job_request_item->name }}</option>
                        @foreach($job_request_item->job_request_item_childs as $key2 => $job_request_child)
                            <option value="{{ $job_request_child->id }}">{{ $job_request_child->name }}</option>
                        @endforeach
                    @endforeach
                </select>
                <span class="text-secondary small">Kosongkan jika bukan sub item</span>
            </div>
            <div class="mb-3">
                <label>Nama Item <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Volume <span class="text-danger">*</span></label>
                <input type="text" name="volume" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Satuan <span class="text-danger">*</span></label>
                <input type="text" name="unit" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Remarks <span class="text-danger">*</span></label>
                <input type="text" name="remarks_reason" class="form-control" required>
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
  <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Item Job Request</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
        </div>
        <form action="" method="POST" id="edit-form" enctype="multipart/form-data">
          @csrf
          @method("PUT")
          <div class="modal-body">
              <div class="mb-3">
                <label>Parent</label>
                <select name="job_request_item_id" class="select2 form-control" id="edit-job-request-item-id">
                    <option></option>
                    @foreach($job_request_items as $key => $job_request_item)
                        <option value="{{ $job_request_item->id }}" data-has-child="{{ count($job_request_item->job_request_item_childs) > 0 ? 1 : 0 }}">{{ $job_request_item->name }}</option>
                        @foreach($job_request_item->job_request_item_childs as $key2 => $job_request_child)
                            <option value="{{ $job_request_child->id }}" data-has-child="{{ count($job_request_child->job_request_item_childs) > 0 ? 1 : 0 }}">{{ $job_request_child->name }}</option>
                        @endforeach
                    @endforeach
                </select>
                <span class="text-secondary small">Kosongkan jika bukan sub item</span>
            </div>
            <div class="mb-3">
                <label>Nama Item <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" id="edit-name" required>
            </div>
            <div class="mb-3 doesnthave-child">
                <label>Volume <span class="text-danger">*</span></label>
                <input type="text" name="volume" class="form-control" id="edit-volume" required>
            </div>
            <div class="mb-3 doesnthave-child">
                <label>Satuan <span class="text-danger">*</span></label>
                <input type="text" name="unit" class="form-control" id="edit-unit" required>
            </div>
            <div class="mb-3 doesnthave-child">
                <label>Remarks <span class="text-danger">*</span></label>
                <input type="text" name="remarks_reason" class="form-control" id="edit-remarks" required>
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

  <div class="modal fade" tabindex="-1" role="dialog" id="delete-modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Hapus Job Request</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
        </div>
        <div class="modal-body">
          <p>Tindakan ini akan menghapus data tersebut dan data yang dihapus tidak dapat di kembalikan, apakah Anda yakin ingin melanjutkan?</p>
        </div>
        <div class="modal-footer">
          <form action="" method="post" id="delete-form">
            @csrf
            @method("DELETE")
            <button type="button" class="btn btn-light font-weight-bolder" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary font-weight-bolder" id="btn-submit-delete">Ya, Saya Yakin</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $(document).on("change", ".check-all", function()
    {
        var isChecked = $(this).is(":checked");
        if(isChecked)
        {
            var child = $(this).data("child");
            $(child).prop("checked", true).trigger("change");
        } else {
            var child = $(this).data("child");
            $(child).prop("checked", false).trigger("change");
        }
    })

    // create events
    $(".btn-create").on("click", function()
    {
      $("#create-modal").modal('show');
    });
    
    $("#create-job-request-item-id").select2({
        dropdownParent: $('#create-modal .modal-content'),
        placeholder: 'Pilih opsi',
        allowClear: true
    });
    
    function initEditSelect2()
    {
        $("#edit-job-request-item-id").select2({
            dropdownParent: $('#edit-modal .modal-content'),
            placeholder: 'Pilih opsi',
            allowClear: true
        });
    }
    initEditSelect2();
    
    
    // edit events
    $(document).on("click", ".btn-edit", function()
    {
      var id = $(this).val();
      var hasChild = $(this).data("has-child");
      $("#edit-job-request-item-id").find("option").prop("disabled", false);
      $("#edit-job-request-item-id").find("option[value=\""+id+"\"]").prop("disabled", true);
      
      $("#edit-form").prop("action", "{{ route('dashboard.job-request-item.index') }}/" + id);
      $("#edit-form")[0].reset();
      if(hasChild == 0)
      {
          $(".doesnthave-child").show();
          $(".doesnthave-child").find("input").prop("required", true);
      }else{
          $(".doesnthave-child").hide();
          $(".doesnthave-child").find("input").prop("required", false);
      }
      $.ajax({
         method: "GET",
         url: "{{ route('dashboard.job-request-item.index') }}/" + id + "/edit",
         success: function(response)
         {
             $("#edit-job-request-item-id").val(response.job_request_item_id).trigger("change.select2");
             $("#edit-name").val(response.name);
             $("#edit-volume").val(response.volume);
             $("#edit-unit").val(response.unit);
             $("#edit-remarks").val(response.remarks_reason);
             $("#edit-status").val(response.status);
             $("#edit-modal").modal("show");
         }
      });
      console.log({id, hasChild});
    });

    // delete events
    $(document).on("click", ".btn-delete", function()
    {
      var id = $(this).val();
      $("#delete-form").attr("action", "{{ route('dashboard.job-request-item.index') }}/" + id);
      $("#delete-modal").modal('show');
    });
  </script>
@endsection
