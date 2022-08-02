@extends('layouts.master')

@section('style')
  <style>
  .text-justify{
    text-align: justify;
  }
  table>thead>tr>th, table>tbody>tr:not(.no-bg)>td{
    padding: 20px !important;
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
  
    .form-control {
        background: #F4F4F4;
        box-shadow: 0px 4px 0px rgba(208, 208, 208, 0.25);
        border-radius: 7px;
        border: 0px;
        height: 46px;
    }
    
    .form-control-file {
        background: #E3E1E1;
        box-shadow: 0px 4px 0px #E3E1E1;
        border-radius: 7px;
        border: 0px;
        height: 46px;
        text-align: center;
        padding: 10px 10px 0px 10px;
        cursor: pointer;
        font-size: 18px;
        color: #9B9B9B;
        font-weight: 300;
    }
</style>
@endsection

@section('breadcrumb')
    <div class="row">
        <div class="col-6">
          <h3>Edit Role</h3>
        </div>
        <div class="col-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  Beranda
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.role.index') }}">
                        Manajemen Role
                    </a>
                </li>
                <li class="breadcrumb-item active">
                  Edit Role
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')

  <div class="row mt-3">
    <div class="col-12 px-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Edit Hak Akses</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.role.update', $role->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="mb-3">
                        <label>Nama Role</label>
                        <input name="name" class="form-control" placeholder="Masukkan nama" value="{{ $role->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Manajemen User</label>
                        <div class="row">
                            <div class="col-12">
                                <label for="edit-check-all-user">
                                    <input class="checkbox_animated check-all" id="edit-check-all-user"
                                        type="checkbox" data-child=".edit-user-child">
                                    Semua Akses
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="edit-read-user">
                                    <input class="checkbox_animated edit-user-child" id="edit-read-user"
                                        type="checkbox" name="permission_name[]" value="read_user">
                                    Lihat
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-create-user">
                                    <input class="checkbox_animated edit-user-child" id="edit-create-user"
                                        type="checkbox" name="permission_name[]" value="create_user">
                                    Tambah
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-update-user">
                                    <input class="checkbox_animated edit-user-child" id="edit-update-user"
                                        type="checkbox" name="permission_name[]" value="update_user">
                                    Edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-delete-user">
                                    <input class="checkbox_animated edit-user-child" id="edit-delete-user"
                                        type="checkbox" name="permission_name[]" value="delete_user">
                                    Delete
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Manajemen Hak Akses</label>
                        <div class="row">
                            <div class="col-12">
                                <label for="edit-check-all-role">
                                    <input class="checkbox_animated check-all" id="edit-check-all-role"
                                        type="checkbox" data-child=".edit-role-child">
                                    Semua Akses
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="edit-read-role">
                                    <input class="checkbox_animated edit-role-child" id="edit-read-role"
                                        type="checkbox" name="permission_name[]" value="read_role">
                                    Lihat
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-create-role">
                                    <input class="checkbox_animated edit-role-child" id="edit-create-role"
                                        type="checkbox" name="permission_name[]" value="create_role">
                                    Tambah
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-update-role">
                                    <input class="checkbox_animated edit-role-child" id="edit-update-role"
                                        type="checkbox" name="permission_name[]" value="update_role">
                                    Edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-delete-role">
                                    <input class="checkbox_animated edit-role-child" id="edit-delete-role"
                                        type="checkbox" name="permission_name[]" value="delete_role">
                                    Delete
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Project</label>
                        <div class="row">
                            <div class="col-12">
                                <label for="edit-check-all-project">
                                    <input class="checkbox_animated check-all" id="edit-check-all-project"
                                        type="checkbox" data-child=".edit-project-child">
                                    Semua Akses
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="edit-read-project">
                                    <input class="checkbox_animated edit-project-child" id="edit-read-project"
                                        type="checkbox" name="permission_name[]" value="read_project">
                                    Lihat
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-read-all-project">
                                    <input class="checkbox_animated edit-project-child" id="edit-read-all-project"
                                        type="checkbox" name="permission_name[]" value="read_all_project">
                                    Lihat Semua Data
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-create-project">
                                    <input class="checkbox_animated edit-project-child" id="edit-create-project"
                                        type="checkbox" name="permission_name[]" value="create_project">
                                    Tambah
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-update-project">
                                    <input class="checkbox_animated edit-project-child" id="edit-update-project"
                                        type="checkbox" name="permission_name[]" value="update_project">
                                    Edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-delete-project">
                                    <input class="checkbox_animated edit-project-child" id="edit-delete-project"
                                        type="checkbox" name="permission_name[]" value="delete_project">
                                    Delete
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Job Request</label>
                        <div class="row">
                            <div class="col-12">
                                <label for="edit-check-all-job-request">
                                    <input class="checkbox_animated check-all" id="edit-check-all-job-request"
                                        type="checkbox" data-child=".edit-job-request-child">
                                    Semua Akses
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="edit-read-job-request">
                                    <input class="checkbox_animated edit-job-request-child" id="edit-read-job-request"
                                        type="checkbox" name="permission_name[]" value="read_job_request">
                                    Lihat
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-create-job-request">
                                    <input class="checkbox_animated edit-job-request-child" id="edit-create-job-request"
                                        type="checkbox" name="permission_name[]" value="create_job_request">
                                    Tambah
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-update-job-request">
                                    <input class="checkbox_animated edit-job-request-child" id="edit-update-job-request"
                                        type="checkbox" name="permission_name[]" value="update_job_request">
                                    Edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-delete-job-request">
                                    <input class="checkbox_animated edit-job-request-child" id="edit-delete-job-request"
                                        type="checkbox" name="permission_name[]" value="delete_job_request">
                                    Delete
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Job Request Item</label>
                        <div class="row">
                            <div class="col-12">
                                <label for="edit-check-all-job-request-item">
                                    <input class="checkbox_animated check-all" id="edit-check-all-job-request-item"
                                        type="checkbox" data-child=".edit-job-request-item-child">
                                    Semua Akses
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="edit-read-job-request-item">
                                    <input class="checkbox_animated edit-job-request-item-child" id="edit-read-job-request-item"
                                        type="checkbox" name="permission_name[]" value="read_job_request_item">
                                    Lihat
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-create-job-request-item">
                                    <input class="checkbox_animated edit-job-request-item-child" id="edit-create-job-request-item"
                                        type="checkbox" name="permission_name[]" value="create_job_request_item">
                                    Tambah
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-update-job-request-item">
                                    <input class="checkbox_animated edit-job-request-item-child" id="edit-update-job-request-item"
                                        type="checkbox" name="permission_name[]" value="update_job_request_item">
                                    Edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-delete-job-request-item">
                                    <input class="checkbox_animated edit-job-request-item-child" id="edit-delete-job-request-item"
                                        type="checkbox" name="permission_name[]" value="delete_job_request_item">
                                    Delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-verification-job-request-item">
                                    <input class="checkbox_animated edit-job-request-item-child" id="edit-verification-job-request-item"
                                        type="checkbox" name="permission_name[]" value="verification_job_request_item">
                                    Verifikasi
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Quotataion</label>
                        <div class="row">
                            <div class="col-12">
                                <label for="edit-check-all-quotation">
                                    <input class="checkbox_animated check-all" id="edit-check-all-quotation"
                                        type="checkbox" data-child=".edit-quotation-child">
                                    Semua Akses
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="edit-read-quotation">
                                    <input class="checkbox_animated edit-quotation-child" id="edit-read-quotation"
                                        type="checkbox" name="permission_name[]" value="read_quotation">
                                    Lihat
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-create-quotation">
                                    <input class="checkbox_animated edit-quotation-child" id="edit-create-quotation"
                                        type="checkbox" name="permission_name[]" value="create_quotation">
                                    Tambah
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-update-quotation">
                                    <input class="checkbox_animated edit-quotation-child" id="edit-update-quotation"
                                        type="checkbox" name="permission_name[]" value="update_quotation">
                                    Edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-delete-quotation">
                                    <input class="checkbox_animated edit-quotation-child" id="edit-delete-quotation"
                                        type="checkbox" name="permission_name[]" value="delete_quotation">
                                    Delete
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Quotataion Item</label>
                        <div class="row">
                            <div class="col-12">
                                <label for="edit-check-all-quotation-item">
                                    <input class="checkbox_animated check-all" id="edit-check-all-quotation-item"
                                        type="checkbox" data-child=".edit-quotation-item-child">
                                    Semua Akses
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="edit-read-quotation-item">
                                    <input class="checkbox_animated edit-quotation-item-child" id="edit-read-quotation-item"
                                        type="checkbox" name="permission_name[]" value="read_quotation_item">
                                    Lihat
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-create-quotation-item">
                                    <input class="checkbox_animated edit-quotation-item-child" id="edit-create-quotation-item"
                                        type="checkbox" name="permission_name[]" value="create_quotation_item">
                                    Tambah
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-update-quotation-item">
                                    <input class="checkbox_animated edit-quotation-item-child" id="edit-update-quotation-item"
                                        type="checkbox" name="permission_name[]" value="update_quotation_item">
                                    Edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-delete-quotation-item">
                                    <input class="checkbox_animated edit-quotation-item-child" id="edit-delete-quotation-item"
                                        type="checkbox" name="permission_name[]" value="delete_quotation_item">
                                    Delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-verification-quotation-item">
                                    <input class="checkbox_animated edit-quotation-item-child" id="edit-verification-quotation-item"
                                        type="checkbox" name="permission_name[]" value="verification_quotation_item">
                                    Verifikasi
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-verification-status-quotation-item">
                                    <input class="checkbox_animated edit-quotation-item-child" id="edit-verification-status-quotation-item"
                                        type="checkbox" name="permission_name[]" value="verification_status_quotation_item">
                                    Verifikasi Status
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Work Order</label>
                        <div class="row">
                            <div class="col-12">
                                <label for="edit-check-all-work-order">
                                    <input class="checkbox_animated check-all" id="edit-check-all-work-order"
                                        type="checkbox" data-child=".edit-work-order-child">
                                    Semua Akses
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="edit-read-work-order">
                                    <input class="checkbox_animated edit-work-order-child" id="edit-read-work-order"
                                        type="checkbox" name="permission_name[]" value="read_work_order">
                                    Lihat
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Work Order Item</label>
                        <div class="row">
                            <div class="col-12">
                                <label for="edit-check-all-work-order-item">
                                    <input class="checkbox_animated check-all" id="edit-check-all-work-order-item"
                                        type="checkbox" data-child=".edit-work-order-item-child">
                                    Semua Akses
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="edit-read-work-order-item">
                                    <input class="checkbox_animated edit-work-order-item-child" id="edit-read-work-order-item"
                                        type="checkbox" name="permission_name[]" value="read_work_order_item">
                                    Lihat
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Opname Report</label>
                        <div class="row">
                            <div class="col-12">
                                <label for="edit-check-all-opname-report">
                                    <input class="checkbox_animated check-all" id="edit-check-all-opname-report"
                                        type="checkbox" data-child=".edit-opname-report-child">
                                    Semua Akses
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="edit-read-opname-report">
                                    <input class="checkbox_animated edit-opname-report-child" id="edit-read-opname-report"
                                        type="checkbox" name="permission_name[]" value="read_opname_report">
                                    Lihat
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Opname Report Item</label>
                        <div class="row">
                            <div class="col-12">
                                <label for="edit-check-all-opname-report-item">
                                    <input class="checkbox_animated check-all" id="edit-check-all-opname-report-item"
                                        type="checkbox" data-child=".edit-opname-report-item-child">
                                    Semua Akses
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="edit-read-opname-report-item">
                                    <input class="checkbox_animated edit-opname-report-item-child" id="edit-read-opname-report-item"
                                        type="checkbox" name="permission_name[]" value="read_opname_report_item">
                                    Lihat
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-verification-production-item">
                                    <input class="checkbox_animated edit-opname-report-item-child" id="edit-verification-production-item"
                                        type="checkbox" name="permission_name[]" value="verification_production_opname_report_item">
                                    Verifikasi Produksi
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="edit-verification-ppic-item">
                                    <input class="checkbox_animated edit-opname-report-item-child" id="edit-verification-ppic-item"
                                        type="checkbox" name="permission_name[]" value="verification_ppic_opname_report_item">
                                    Verifikasi PPIC
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="text-end mt-3">
                        <a href="{{ route('dashboard.role.index') }}">
                            <button class="btn btn-dark" type="button">Kembali</button>
                        </a>
                        <button class="btn btn-p">Submit</button>
                    </div>
                </form>
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
            }
        })
        $(document).ready( function () {
            $.ajax({
                method: "GET",
                url: "{{ route('dashboard.role.edit', $role->id) }}?data=true"
            }).done(function (response) {
                console.log(response);
                if (response != null) {
                    $("#edit-name").val(response.name);
                    response.permissions.forEach(function (permission) {
                        $("input[value=" + permission.permission_name + "]").prop("checked", true);
                    });
                }
            });
        });
        
        $(".edit-input-image").on('change', function(){
            $('.form-control-file').css('background', '#278ac5');
            $('.form-control-file').css('color', 'white');
            $('.form-control-file').css('box-shadow', '0px 4px 0px #278ac5');
            $('.label-edit-input-image').text('Ganti File');
        });
    </script>
@endsection
