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
      <h3>Setting Judul Work Order</h3>
    </div>
    <div class="col-6">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          Beranda
        </li>
        <li class="breadcrumb-item">
          Settings
        </li>
        <li class="breadcrumb-item active">
          Work Order
        </li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('dashboard.setting.work-order.update', 'update') }}" method="POST" id="create-form" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="mb-3">
                                <label>Judul <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" placeholder="Masukkan data.." value="{{ $setting->title ?? '' }}" required>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary font-weight-bolder">Simpan</button>
                            </div>
                        </form>
                    </div>
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
      $("#edit-form").attr("action", "{{ route('dashboard.setting.work-order.index') }}/" + id);
      $.ajax({
        method: "GET",
        url: "{{ route('dashboard.setting.work-order.index') }}/" + id + "/edit?_token={{ csrf_token() }}"
      }).done(function(response)
      {
        $("#edit-title").val(response.title);
        $("#edit-modal").modal('show');
      });
    });

    // delete events
    $(document).on("click", ".btn-delete", function()
    {
      var id = $(this).data('id');
      $("#delete-form").attr("action", "{{ route('dashboard.setting.work-order.index') }}/" + id);
      $("#delete-modal").modal('show');
    });
  </script>
@endsection
