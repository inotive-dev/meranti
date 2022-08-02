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
      <h3>Job Request</h3>
    </div>
    <div class="col-6">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          Beranda
        </li>
        <li class="breadcrumb-item active">
          Job Request
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
            @if(in_array('create_job_request', $userPermissions))
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
                <th class="">Tipe JR</th>
                <th>Nomor</th>
                <th class="">Revisi</th>
                <th class="">Referensi</th>
                <th class="">User 1</th>
                <th class="">User 2</th>
                @if(in_array('update_job_request', $userPermissions) || in_array('delete_job_request', $userPermissions) || in_array('read_job_request_item', $userPermissions))
                    <th class="text-nowrap text-end" style="width: 10%">Aksi</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @php
                $no = 1;  
              @endphp
              @foreach($job_requests as $job_request)
                <tr>
                  <td class="align-middle text-capitalize">{{ $job_request->type ?? '-' }}</td>
                  <td class="align-middle">{{ $job_request->number ?? '-' }}</td>
                  <td class="align-middle">{{ $job_request->revision ?? '-' }}</td>
                  <td class="align-middle">{{ $job_request->reference ?? '-' }}</td>
                  <td class="align-middle">{{ $job_request->create_user->name ?? '-' }}</td>
                  <td class="align-middle">{{ $job_request->user->name ?? '-' }}</td>
                  @if(in_array('update_job_request', $userPermissions) || in_array('delete_job_request', $userPermissions) || in_array('read_job_request_item', $userPermissions))
                      <td class="text-nowrap">
                            @if(in_array('read_job_request_item', $userPermissions))
                                <a href="{{ route('dashboard.job-request.export', $job_request->id) }}" class="btn btn-success">
                                  <i data-feather="excel" class="align-middle"></i>
                                  <span class="ms-1 align-middle">Export</span>
                                </a>
                                <a href="{{ route('dashboard.job-request-item.index', ['job_request_id' => $job_request->id]) }}" class="btn btn-outline-info" data-id="{{ $job_request->id }}">
                                  <i data-feather="edit" class="align-middle"></i>
                                  <span class="ms-1 align-middle">Detail</span>
                                </a>
                            @endif
                            @if(in_array('update_job_request', $userPermissions))
                                <a href="javascript:;" class="btn btn-outline-primary btn-edit" data-id="{{ $job_request->id }}">
                                  <i data-feather="edit" class="align-middle"></i>
                                  <span class="ms-1 align-middle">Edit</span>
                                </a>
                            @endif
                            @if(in_array('delete_job_request', $userPermissions))
                                <button class="btn btn-outline-danger btn-delete" data-id="{{ $job_request->id }}">
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
          <h5 class="modal-title">Tambah Job Request</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
        </div>
        <form action="{{ route('dashboard.job-request.store') }}" method="POST" id="create-form" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <input type="hidden" name="project_id" value="{{ request()->project_id }}">
            <div class="mb-3">
              <label>User 2 <span class="text-danger">*</span></label>
              <select name="user_id" class="form-control" required>
                  <option value="">Pilih User</option>
                  @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                  @endforeach
              </select>
            </div>
            @if(count($project->job_requests) > 0)
                <div class="mb-3">
                  <label>Pilih JR <span class="text-danger">*</span></label>
                  <select name="type" class="form-control" required>
                        <option value="aktualisasi">Aktualisasi</option>
                        <option value="revisi">Revisi</option>
                        <option value="additional">Additional</option>
                  </select>
                </div>
            @endif
            <div class="mb-3">
              <label>Nomor <span class="text-danger">*</span></label>
              <input type="text" name="number" class="form-control" placeholder="Masukkan data.." required>
            </div>
            <div class="mb-3">
              <label>Revisi <span class="text-danger">*</span></label>
              <input type="text" name="revision" class="form-control" placeholder="Masukkan data.." required>
            </div>
            <div class="mb-3">
              <label>Referensi <span class="text-danger">*</span></label>
              <input type="text" name="reference" class="form-control" placeholder="Masukkan data.." required>
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
          <h5 class="modal-title">Edit Job Request</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
        </div>
        <form action="" method="POST" id="edit-form" enctype="multipart/form-data">
          @csrf
          @method("PUT")
          <div class="modal-body">
            <div class="mb-3">
              <label>User 2 <span class="text-danger">*</span></label>
              <select name="user_id" class="form-control" id="edit-user" required>
                  <option value="">Pilih User</option>
                  @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                  @endforeach
              </select>
            </div>
            @if(count($project->job_requests) > 0)
                <div class="mb-3">
                  <label>Pilih JR <span class="text-danger">*</span></label>
                  <select name="type" class="form-control" id="edit-type" required>
                        <option value="aktualisasi">Aktualisasi</option>
                        <option value="revisi">Revisi</option>
                        <option value="additional">Additional</option>
                  </select>
                </div>
            @endif
            <div class="mb-3">
              <label>Nomor <span class="text-danger">*</span></label>
              <input type="text" name="number" class="form-control" id="edit-number" placeholder="Masukkan data.." required>
            </div>
            <div class="mb-3">
              <label>Revisi <span class="text-danger">*</span></label>
              <input type="text" name="revision" class="form-control" id="edit-revision" placeholder="Masukkan data.." required>
            </div>
            <div class="mb-3">
              <label>Referensi <span class="text-danger">*</span></label>
              <input type="text" name="reference" class="form-control" id="edit-reference" placeholder="Masukkan data.." required>
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
    // create events
    $(".btn-create").on("click", function()
    {
      $("#create-modal").modal('show');
    });

    // edit events
    $(document).on("click", ".btn-edit", function()
    {
      var id = $(this).data('id');
      $("#edit-form").trigger("reset");
      $("#edit-form").attr("action", "{{ route('dashboard.job-request.index') }}/" + id);
      $.ajax({
        method: "GET",
        url: "{{ route('dashboard.job-request.index') }}/" + id + "/edit?_token={{ csrf_token() }}"
      }).done(function(response)
      {
        $("#edit-user").val(response.user_id).trigger('change');
        $("#edit-type").val(response.type).trigger('change');
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
      $("#delete-form").attr("action", "{{ route('dashboard.job-request.index') }}/" + id);
      $("#delete-modal").modal('show');
    });
  </script>
@endsection
