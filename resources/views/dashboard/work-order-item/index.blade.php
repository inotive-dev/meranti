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
      <h3>Work Order Item</h3>
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
          <a href="{{ route('dashboard.work-order.show', $quotation->job_request->project_id) }}">Detail</a>
        </li>
        <li class="breadcrumb-item active">
          Item
        </li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
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

  <div class="modal fade" role="dialog" id="create-modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Item Quotation</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
        </div>
        <form action="{{ route('dashboard.quotation-item.store') }}" method="POST" id="create-form" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <input type="hidden" name="job_request_id" value="{{ request()->job_request_id }}">
            <div class="mb-3">
                <label>Parent</label>
                <select name="quotation_item_id" class="select2 form-control" id="create-quotation-item-id">
                    <option></option>
                    @foreach($quotation_items as $key => $quotation_item)
                        <option value="{{ $quotation_item->id }}">{{ $quotation_item->name }}</option>
                        @foreach($quotation_item->quotation_item_childs as $key2 => $quotation_item_child)
                            <option value="{{ $quotation_item_child->id }}">{{ $quotation_item_child->name }}</option>
                        @endforeach
                    @endforeach
                </select>
                <span class="text-secondary small">Kosongkan jika bukan sub item</span>
            </div>
            <div class="mb-3">
                <label>Volume <span class="text-danger">*</span></label>
                <input type="text" name="volume" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Unit Price <span class="text-danger">*</span></label>
                <input type="text" name="unit_price" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Service <span class="text-danger">*</span></label>
                <input type="text" name="service" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Material <span class="text-danger">*</span></label>
                <input type="text" name="material" class="form-control" required>
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
          <h5 class="modal-title">Edit Item Quotation</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
        </div>
        <form action="" method="POST" id="edit-form" enctype="multipart/form-data">
          @csrf
          @method("PUT")
          <div class="modal-body">
              <div class="mb-3">
                <label>Parent</label>
                <select name="quotation_item_id" class="select2 form-control" id="edit-quotation-item-id">
                    <option></option>
                    @foreach($quotation_items as $key => $quotation_item)
                        <option value="{{ $quotation_item->id }}" data-has-child="{{ count($quotation_item->quotation_item_childs) > 0 ? 1 : 0 }}">{{ $quotation_item->name }}</option>
                        @foreach($quotation_item->quotation_item_childs as $key2 => $quotation_item_child)
                            <option value="{{ $quotation_item_child->id }}" data-has-child="{{ count($quotation_item_child->quotation_item_childs) > 0 ? 1 : 0 }}">{{ $quotation_item_child->name }}</option>
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
                <label>Unit Price <span class="text-danger">*</span></label>
                <input type="text" name="unit_price" class="form-control" id="edit-unit-price" required>
            </div>
            <div class="mb-3 doesnthave-child">
                <label>Service <span class="text-danger">*</span></label>
                <input type="text" name="service" class="form-control" id="edit-service" required>
            </div>
            <div class="mb-3 doesnthave-child">
                <label>Material <span class="text-danger">*</span></label>
                <input type="text" name="material" class="form-control" id="edit-material" required>
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
    
    $("#create-quotation-item-id").select2({
        dropdownParent: $('#create-modal .modal-content'),
        placeholder: 'Pilih opsi',
        allowClear: true
    });
    
    function initEditSelect2()
    {
        $("#edit-quotation-item-id").select2({
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
      $("#edit-quotation-item-id").find("option").prop("disabled", false);
      $("#edit-quotation-item-id").find("option[value=\""+id+"\"]").prop("disabled", true);
      
      $("#edit-form").prop("action", "{{ route('dashboard.quotation-item.index') }}/" + id);
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
         url: "{{ route('dashboard.quotation-item.index') }}/" + id + "/edit",
         success: function(response)
         {
             $("#edit-quotation-item-id").val(response.quotation_item_id).trigger("change.select2");
             $("#edit-name").val(response.name);
             $("#edit-volume").val(response.volume);
             $("#edit-unit-price").val(response.unit_price);
             $("#edit-service").val(response.service);
             $("#edit-material").val(response.material);
             $("#edit-modal").modal("show");
         }
      });
      console.log({id, hasChild});
    });

    // delete events
    $(document).on("click", ".btn-delete", function()
    {
      var id = $(this).val();
      $("#delete-form").attr("action", "{{ route('dashboard.quotation-item.index') }}/" + id);
      $("#delete-modal").modal('show');
    });
  </script>
@endsection
