@extends('layouts.master')

@section('style')
  <style>
  .text-justify{
    text-align: justify;
  }
  table>thead>tr>th, table>tbody>tr:not(.no-bg)>td{
    padding: 30px !important;
  }
  table>thead>tr>th, table>tbody>tr>td{
    border-bottom: none !important;
  }
  table>tbody>tr:not(.no-bg)>td{
    background: #FFFFFF !important;
  }
  table>tbody>tr:not(.no-bg){
    box-shadow: 0px 4px 9px rgba(194, 194, 194, 0.25);
  }

  table>tbody>tr:not(.no-bg)>td:first-child{
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
  }
  table>tbody>tr:not(.no-bg)>td:last-child{
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
  }
  </style>
@endsection

@section('breadcrumb')
  <div class="row">
    <div class="col-6">
      <h3>Seting Job Request</h3>
    </div>
    <div class="col-6">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          Beranda
        </li>
        <li class="breadcrumb-item">
          Settings
        </li>
        <li class="breadcrumb-item">
          <a href="{{ route('dashboard.setting.job-request.index') }}">
            Job Request
          </a>
        </li>
        @if ($setting_job_request->level > 2)
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard.setting.job-request.show', $setting_job_request->r_setting_job_request_parent->r_setting_job_request_parent->id) }}">
              {{ $setting_job_request->r_setting_job_request_parent->r_setting_job_request_parent->title }}
            </a>
          </li>
        @endif

        @if ($setting_job_request->level > 1)
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard.setting.job-request.show', $setting_job_request->r_setting_job_request_parent->id) }}">
              {{ $setting_job_request->r_setting_job_request_parent->title }}
            </a>
          </li>
        @endif

        <li class="breadcrumb-item active">
          {{ $setting_job_request->title }}
        </li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12 mb-3 text-end">
        <button class="btn btn-primary btn-create">
          <span class="ms-1 align-middle">
            <i data-feather="plus" class="align-middle"></i>
            Tambah
          </span>
        </button>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-12 px-3">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th style="width: 50px !important;">No.</th>
                <th class="">Judul</th>
                <th class="">Satuan</th>
                <th class="text-nowrap text-end" style="width: 10%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php
                $no = 1;
              @endphp
              @foreach($setting_job_request->r_setting_job_request_childs as $setting_job_request_item)
                <tr>
                  <td style="width: 50px !important;" class="align-middle text-center">{{ $no++ }}</td>
                  <td class="align-middle">
                    {{ $setting_job_request_item->title ?? '-' }}
                  </td>
                  <td class="align-middle">
                    {{ $setting_job_request_item->unit ?? '-' }}
                  </td>

                  <td class="text-nowrap">
                    @if ($setting_job_request_item->level < 4)
                      <a href="{{ route('dashboard.setting.job-request.show', $setting_job_request_item->id) }}" class="btn btn-outline-primary" data-id="{{ $setting_job_request_item->id }}">
                        <i data-feather="edit" class="align-middle"></i>
                        <span class="ms-1 align-middle">Sub</span>
                      </a>
                    @endif
                    <a href="javascript:;" class="btn btn-outline-primary btn-edit" data-id="{{ $setting_job_request_item->id }}">
                      <i data-feather="edit" class="align-middle"></i>
                      <span class="ms-1 align-middle">Edit</span>
                    </a>
                    <button class="btn btn-outline-danger btn-delete" data-id="{{ $setting_job_request_item->id }}">
                      <i data-feather="trash-2" class="align-middle"></i>
                      <span class="ms-1 align-middle">Hapus</span>
                    </button>
                  </td>
                </tr>
                <tr class="no-bg">
                  <td colspan="5"></td>
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
        <form action="{{ route('dashboard.setting.job-request.store') }}" method="POST" id="create-form" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <input type="hidden" name="setting_job_request_id" value="{{ $setting_job_request->id }}">
            <input type="hidden" name="level" value="{{ $setting_job_request->level + 1 }}">
            <div class="form-group">
              <label>Judul <span class="text-danger">*</span></label>
              <input type="text" name="title" class="form-control" placeholder="Masukkan data.." required>
            </div>
            <div class="form-group">
              <label>Satuan <span class="text-danger">*</span></label>
              <input type="text" name="unit" class="form-control" placeholder="Masukkan data.." required>
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
            <div class="form-group">
              <label>Judul <span class="text-danger">*</span></label>
              <input type="text" name="title" class="form-control" id="edit-title" placeholder="Masukkan data..." required>
            </div>
            <div class="form-group">
              <label>Satuan <span class="text-danger">*</span></label>
              <input type="text" name="unit" class="form-control" id="edit-unit" placeholder="Masukkan data.." required>
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
          <h5 class="modal-title">Hapus Biaya Operasional</h5>
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
      $("#edit-form").attr("action", "{{ route('dashboard.setting.job-request.index') }}/" + id);
      $.ajax({
        method: "GET",
        url: "{{ route('dashboard.setting.job-request.index') }}/" + id + "/edit?_token={{ csrf_token() }}"
      }).done(function(response)
      {
        $("#edit-title").val(response.title);
        $("#edit-unit").val(response.unit);
        $("#edit-modal").modal('show');
      });
    });

    // delete events
    $(document).on("click", ".btn-delete", function()
    {
      var id = $(this).data('id');
      $("#delete-form").attr("action", "{{ route('dashboard.setting.job-request.index') }}/" + id);
      $("#delete-modal").modal('show');
    });
  </script>
@endsection
