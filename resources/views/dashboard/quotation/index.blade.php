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
      <h3>Quotation</h3>
    </div>
    <div class="col-6">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          Beranda
        </li>
        <li class="breadcrumb-item active">
          Quotation
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
    <div class="row">
      <div class="col-12 mb-3 text-end">
            @if(in_array('create_quotation', $userPermissions))
                <button class="btn btn-primary btn-create">
                  <span class="ms-1 align-middle">
                    <i data-feather="plus" class="align-middle"></i>
                    Tambah
                  </span>
                </button>
            @endif
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
                @if(in_array('update_quotation', $userPermissions) || in_array('delete_quotation', $userPermissions) || in_array('read_quotation_item', $userPermissions))
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
                  @if(in_array('update_quotation', $userPermissions) || in_array('delete_quotation', $userPermissions) || in_array('read_quotation_item', $userPermissions))
                      <td class="text-nowrap">
                            @if(in_array('read_quotation_item', $userPermissions))
                                <a href="{{ route('dashboard.quotation.export', $quotation->id) }}" class="btn btn-success" data-id="{{ $quotation->id }}">
                                  <i data-feather="file" class="align-middle"></i>
                                  <span class="ms-1 align-middle">Excel</span>
                                </a>
                                <a href="{{ route('dashboard.quotation-item.index', ['quotation_id' => $quotation->id]) }}" class="btn btn-outline-info" data-id="{{ $quotation->id }}">
                                  <i data-feather="edit" class="align-middle"></i>
                                  <span class="ms-1 align-middle">Detail</span>
                                </a>
                            @endif
                            @if(in_array('update_quotation', $userPermissions))
                                <a href="javascript:;" class="btn btn-outline-primary btn-edit" data-id="{{ $quotation->id }}">
                                  <i data-feather="edit" class="align-middle"></i>
                                  <span class="ms-1 align-middle">Edit</span>
                                </a>
                            @endif
                            @if(in_array('delete_quotation', $userPermissions))
                                <button class="btn btn-outline-danger btn-delete" data-id="{{ $quotation->id }}">
                                  <i data-feather="trash-2" class="align-middle"></i>
                                  <span class="ms-1 align-middle">Hapus</span>
                                </button>
                            @endif
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

  <div class="modal fade" tabindex="-1" role="dialog" id="create-modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Quotation</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
        </div>
        <form action="{{ route('dashboard.quotation.store') }}" method="POST" id="create-form" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <input type="hidden" name="project_id" value="{{ request()->project_id }}">
            <div class="mb-3">
              <label>Job Request <span class="text-danger">*</span></label>
              <select name="job_request_id" class="form-control" id="create-job-request-id" required>
                  <option></option>
                  @foreach($job_requests as $key => $job_request)
                    <option value="{{ $job_request->id }}">{{ $job_request->number . ' | ' . $job_request->revision }}</option>
                  @endforeach
              </select>
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
          <h5 class="modal-title">Edit Quotation</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
        </div>
        <form action="" method="POST" id="edit-form" enctype="multipart/form-data">
          @csrf
          @method("PUT")
          <div class="modal-body">
            <div class="mb-3">
              <label>Status <span class="text-danger">*</span></label>
              <select name="status" class="form-control" required>
                  <option value="menunggu">Menunggu</option>
                  <option value="diterima">Diterima</option>
                  <option value="ditolak">Ditolak</option>
              </select>
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
          <h5 class="modal-title">Hapus Quotation</h5>
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
    // create events
    $(".btn-create").on("click", function()
    {
      $("#create-modal").modal('show');
    });
    
    $("#create-job-request-id").select2({
        dropdownParent: $('#create-modal .modal-content'),
        placeholder: 'Pilih opsi',
        allowClear: true
    });
    
    // edit events
    $(document).on("click", ".btn-edit", function()
    {
      var id = $(this).data('id');
      $("#edit-form").trigger("reset");
      $("#edit-form").attr("action", "{{ route('dashboard.quotation.index') }}/" + id);
      $.ajax({
        method: "GET",
        url: "{{ route('dashboard.quotation.index') }}/" + id + "/edit?_token={{ csrf_token() }}"
      }).done(function(response)
      {
        $("#edit-number").val(response.number);
        $("#edit-revision").val(response.revision);
        $("#edit-reference").val(response.reference);
        $("#edit-modal").modal('show');
      });
    });

    // delete events
    $(document).on("click", ".btn-delete", function()
    {
      var id = $(this).data('id');
      $("#delete-form").attr("action", "{{ route('dashboard.quotation.index') }}/" + id);
      $("#delete-modal").modal('show');
    });
  </script>
@endsection
