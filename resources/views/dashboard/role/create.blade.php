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
          <h3>Tambah Role</h3>
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
                  Tambah Role
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
                <h4 class="card-title">Form Tambah Hak Akses</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.role.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>Nama Role</label>
                        <input name="name" class="form-control" placeholder="Masukkan nama" required>
                    </div>
                    <div class="mb-3">
                        <label>Manajemen User</label>
                        <div class="row">
                            <div class="col-12">
                                <label for="create-check-all-user">
                                    <input class="checkbox_animated check-all" id="create-check-all-user"
                                        type="checkbox" data-child=".create-user-child">
                                    Semua Akses
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="create-read-user">
                                    <input class="checkbox_animated create-user-child" id="create-read-user"
                                        type="checkbox" name="permission_name[]" value="read_user">
                                    Lihat
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-create-user">
                                    <input class="checkbox_animated create-user-child" id="create-create-user"
                                        type="checkbox" name="permission_name[]" value="create_user">
                                    Tambah
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-update-user">
                                    <input class="checkbox_animated create-user-child" id="create-update-user"
                                        type="checkbox" name="permission_name[]" value="update_user">
                                    Edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-delete-user">
                                    <input class="checkbox_animated create-user-child" id="create-delete-user"
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
                                <label for="create-check-all-role">
                                    <input class="checkbox_animated check-all" id="create-check-all-role"
                                        type="checkbox" data-child=".create-role-child">
                                    Semua Akses
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="create-read-role">
                                    <input class="checkbox_animated create-role-child" id="create-read-role"
                                        type="checkbox" name="permission_name[]" value="read_role">
                                    Lihat
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-create-role">
                                    <input class="checkbox_animated create-role-child" id="create-create-role"
                                        type="checkbox" name="permission_name[]" value="create_role">
                                    Tambah
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-update-role">
                                    <input class="checkbox_animated create-role-child" id="create-update-role"
                                        type="checkbox" name="permission_name[]" value="update_role">
                                    Edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-delete-role">
                                    <input class="checkbox_animated create-role-child" id="create-delete-role"
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
                                <label for="create-check-all-project">
                                    <input class="checkbox_animated check-all" id="create-check-all-project"
                                        type="checkbox" data-child=".create-project-child">
                                    Semua Akses
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="create-read-project">
                                    <input class="checkbox_animated create-project-child" id="create-read-project"
                                        type="checkbox" name="permission_name[]" value="read_project">
                                    Lihat
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-read-all-project">
                                    <input class="checkbox_animated create-project-child" id="create-read-all-project"
                                        type="checkbox" name="permission_name[]" value="read_all_project">
                                    Lihat Semua Data
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-create-project">
                                    <input class="checkbox_animated create-project-child" id="create-create-project"
                                        type="checkbox" name="permission_name[]" value="create_project">
                                    Tambah
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-update-project">
                                    <input class="checkbox_animated create-project-child" id="create-update-project"
                                        type="checkbox" name="permission_name[]" value="update_project">
                                    Edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-delete-project">
                                    <input class="checkbox_animated create-project-child" id="create-delete-project"
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
                                <label for="create-check-all-job-request">
                                    <input class="checkbox_animated check-all" id="create-check-all-job-request"
                                        type="checkbox" data-child=".create-job-request-child">
                                    Semua Akses
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="create-read-job-request">
                                    <input class="checkbox_animated create-job-request-child" id="create-read-job-request"
                                        type="checkbox" name="permission_name[]" value="read_job_request">
                                    Lihat
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-create-job-request">
                                    <input class="checkbox_animated create-job-request-child" id="create-create-job-request"
                                        type="checkbox" name="permission_name[]" value="create_job_request">
                                    Tambah
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-update-job-request">
                                    <input class="checkbox_animated create-job-request-child" id="create-update-job-request"
                                        type="checkbox" name="permission_name[]" value="update_job_request">
                                    Edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-delete-job-request">
                                    <input class="checkbox_animated create-job-request-child" id="create-delete-job-request"
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
                                <label for="create-check-all-job-request-item">
                                    <input class="checkbox_animated check-all" id="create-check-all-job-request-item"
                                        type="checkbox" data-child=".create-job-request-item-child">
                                    Semua Akses
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="create-read-job-request-item">
                                    <input class="checkbox_animated create-job-request-item-child" id="create-read-job-request-item"
                                        type="checkbox" name="permission_name[]" value="read_job_request_item">
                                    Lihat
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-create-job-request-item">
                                    <input class="checkbox_animated create-job-request-item-child" id="create-create-job-request-item"
                                        type="checkbox" name="permission_name[]" value="create_job_request_item">
                                    Tambah
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-update-job-request-item">
                                    <input class="checkbox_animated create-job-request-item-child" id="create-update-job-request-item"
                                        type="checkbox" name="permission_name[]" value="update_job_request_item">
                                    Edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-delete-job-request-item">
                                    <input class="checkbox_animated create-job-request-item-child" id="create-delete-job-request-item"
                                        type="checkbox" name="permission_name[]" value="delete_job_request_item">
                                    Delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-verification-job-request-item">
                                    <input class="checkbox_animated create-job-request-item-child" id="create-verification-job-request-item"
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
                                <label for="create-check-all-quotation">
                                    <input class="checkbox_animated check-all" id="create-check-all-quotation"
                                        type="checkbox" data-child=".create-quotation-child">
                                    Semua Akses
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="create-read-quotation">
                                    <input class="checkbox_animated create-quotation-child" id="create-read-quotation"
                                        type="checkbox" name="permission_name[]" value="read_quotation">
                                    Lihat
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-create-quotation">
                                    <input class="checkbox_animated create-quotation-child" id="create-create-quotation"
                                        type="checkbox" name="permission_name[]" value="create_quotation">
                                    Tambah
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-update-quotation">
                                    <input class="checkbox_animated create-quotation-child" id="create-update-quotation"
                                        type="checkbox" name="permission_name[]" value="update_quotation">
                                    Edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-delete-quotation">
                                    <input class="checkbox_animated create-quotation-child" id="create-delete-quotation"
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
                                <label for="create-check-all-quotation-item">
                                    <input class="checkbox_animated check-all" id="create-check-all-quotation-item"
                                        type="checkbox" data-child=".create-quotation-item-child">
                                    Semua Akses
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="create-read-quotation-item">
                                    <input class="checkbox_animated create-quotation-item-child" id="create-read-quotation-item"
                                        type="checkbox" name="permission_name[]" value="read_quotation_item">
                                    Lihat
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-create-quotation-item">
                                    <input class="checkbox_animated create-quotation-item-child" id="create-create-quotation-item"
                                        type="checkbox" name="permission_name[]" value="create_quotation_item">
                                    Tambah
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-update-quotation-item">
                                    <input class="checkbox_animated create-quotation-item-child" id="create-update-quotation-item"
                                        type="checkbox" name="permission_name[]" value="update_quotation_item">
                                    Edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-delete-quotation-item">
                                    <input class="checkbox_animated create-quotation-item-child" id="create-delete-quotation-item"
                                        type="checkbox" name="permission_name[]" value="delete_quotation_item">
                                    Delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-verification-quotation-item">
                                    <input class="checkbox_animated create-quotation-item-child" id="create-verification-quotation-item"
                                        type="checkbox" name="permission_name[]" value="verification_quotation_item">
                                    Verifikasi
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-verification-status-quotation-item">
                                    <input class="checkbox_animated create-quotation-item-child" id="create-verification-status-quotation-item"
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
                                <label for="create-check-all-work-order">
                                    <input class="checkbox_animated check-all" id="create-check-all-work-order"
                                        type="checkbox" data-child=".create-work-order-child">
                                    Semua Akses
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="create-read-work-order">
                                    <input class="checkbox_animated create-work-order-child" id="create-read-work-order"
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
                                <label for="create-check-all-work-order-item">
                                    <input class="checkbox_animated check-all" id="create-check-all-work-order-item"
                                        type="checkbox" data-child=".create-work-order-item-child">
                                    Semua Akses
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="create-read-work-order-item">
                                    <input class="checkbox_animated create-work-order-item-child" id="create-read-work-order-item"
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
                                <label for="create-check-all-opname-report">
                                    <input class="checkbox_animated check-all" id="create-check-all-opname-report"
                                        type="checkbox" data-child=".create-opname-report-child">
                                    Semua Akses
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="create-read-opname-report">
                                    <input class="checkbox_animated create-opname-report-child" id="create-read-opname-report"
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
                                <label for="create-check-all-opname-report-item">
                                    <input class="checkbox_animated check-all" id="create-check-all-opname-report-item"
                                        type="checkbox" data-child=".create-opname-report-item-child">
                                    Semua Akses
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="create-read-opname-report-item">
                                    <input class="checkbox_animated create-opname-report-item-child" id="create-read-opname-report-item"
                                        type="checkbox" name="permission_name[]" value="read_opname_report_item">
                                    Lihat
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-verification-production-item">
                                    <input class="checkbox_animated create-opname-report-item-child" id="create-verification-production-item"
                                        type="checkbox" name="permission_name[]" value="verification_production_opname_report_item">
                                    Verifikasi Produksi
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="create-verification-ppic-item">
                                    <input class="checkbox_animated create-opname-report-item-child" id="create-verification-ppic-item"
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
        
        $('.btn-input-image').on('click', function(){
            $('.create-input-image').click();
        });
        
        $(".create-input-image").on('change', function(){
            $('.form-control-file').css('background', '#278ac5');
            $('.form-control-file').css('color', 'white');
            $('.form-control-file').css('box-shadow', '0px 4px 0px #278ac5');
            $('.label-create-input-image').text('Ganti File');
        });
    </script>
@endsection
