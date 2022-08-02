@extends('layouts.master')

@section('style')
<style>
    .text-justify {
        text-align: justify;
    }

    table>thead>tr>th,
    table>tbody>tr:not(.no-bg)>td {
        padding: 20px !important;
    }

    table>thead>tr>th,
    table>tbody>tr>td {
        border-bottom: none !important;
    }

    table>tbody>tr:not(.no-bg)>td {
        background: #FFFFFF !important;
    }

    table>tbody>tr:not(.no-bg) {
        box-shadow: 0px 4px 9px rgba(194, 194, 194, 0.25);
    }

    table>tbody>tr:not(.no-bg)>td:first-child {
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }

    table>tbody>tr:not(.no-bg)>td:last-child {
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
</style>
@endsection

@section('breadcrumb')
<div class="row">
    <div class="col-6">
        <h3>Role</h3>
    </div>
    <div class="col-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                Beranda
            </li>
            <li class="breadcrumb-item active">
                Role
            </li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12 text-end">
        <a class="btn btn-primary btn-create text-white" href="{{ route('dashboard.role.create') }}">
            <span class="ms-1 align-middle">Tambah</span>
        </a>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12 px-3">
        <div class="table-responsive">
            <table class="table ">
                <thead>
                    <tr>
                        <th style="width: 50px !important;">No.</th>
                        <th>Nama Role</th>
                        <th>Hak Akses</th>
                        <th class="text-nowrap text-end" style="width: 10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach($roles as $key => $role)
                        @php
                            $permissions = $role->permissions->pluck('permission_name')->toArray();
                        @endphp
                        <tr>
                            <td style="width: 1%" class="align-top">{{ $no++ }}</td>
                            <td class="text-nowrap">
                                {{ $role->name }}
                            </td>
                            <td class="text-nowrap">
                                <div class="mb-3">
                                    <label class="small">Manajemen User</label>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('read_user', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Lihat</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('create_user', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Tambah</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('update_user', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Edit</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('delete_user', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Hapus</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small">Manajemen Hak Akses</label>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('read_role', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Lihat</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('create_role', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Tambah</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('update_role', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Edit</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('delete_role', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Hapus</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small">Project</label>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('read_project', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Lihat</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('read_all_project', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Lihat Semua Data</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('create_project', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Tambah</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('update_project', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Edit</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('delete_project', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Hapus</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small">Job Request</label>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('read_job_request', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Lihat</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('create_job_request', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Tambah</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('update_job_request', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Edit</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('delete_job_request', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Hapus</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small">Job Request Item</label>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('read_job_request_item', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Lihat</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('create_job_request_item', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Tambah</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('update_job_request_item', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Edit</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('delete_job_request_item', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Hapus</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('verification_job_request_item', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Verifikasi</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small">Quotation</label>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('read_quotation', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Lihat</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('create_quotation', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Tambah</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('update_quotation', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Edit</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i class="fa {{ in_array('delete_quotation', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Hapus</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small">Quotation Item</label>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('read_quotation_item', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Lihat</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('create_quotation_item', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Tambah</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('update_quotation_item', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Edit</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i class="fa {{ in_array('delete_quotation_item', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Hapus</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i class="fa {{ in_array('verification_quotation_item', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Verifikasi</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i class="fa {{ in_array('verification_status_quotation_item', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Verifikasi Status</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small">Work Order</label>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('read_work_order', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Lihat</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small">Work Order Item</label>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('read_work_order_item', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Lihat</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small">Opname Report</label>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('read_opname_report', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Lihat</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small">Quotation Item</label>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <i
                                                class="fa {{ in_array('read_opname_report_item', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Lihat</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i class="fa {{ in_array('verification_production_opname_report_item', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Verifikasi Produksi</span>
                                        </div>
                                        <div class="col-md-3">
                                            <i class="fa {{ in_array('verification_ppic_opname_report_item', $permissions) ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} align-middle"></i>
                                            <span class="align-middle">Verifikasi PPIC</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-nowrap">
                                <a class="btn-custom btn-edit text-secondary me-2" href="{{ route('dashboard.role.edit', $role->id) }}">Edit</a>
                                <span class="btn-custom btn-delete text-danger" data-id="{{ $role->id }}">Hapus</span>
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
        <div class="mb-3" style="float: right;">  
         {{ $roles->appends(Request::except('page'))->links() }}
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="delete-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Hak Akses</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                    data-bs-original-title="" title=""></button>
            </div>
            <div class="modal-body">
                <p>Tindakan ini akan menghapus data tersebut dan data yang dihapus tidak dapat di kembalikan, apakah
                    Anda yakin ingin melanjutkan?</p>
            </div>
            <div class="modal-footer">
                <form action="" method="post" id="delete-form">
                    @csrf
                    @method("DELETE")
                    <button type="button" class="btn btn-light font-weight-bolder"
                        data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary font-weight-bolder">Ya, Saya Yakin</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

    // delete events
    $(document).on("click", ".btn-delete", function () {
        var id = $(this).data('id');
        $("#delete-form").attr("action", "{{ route('dashboard.role.index') }}/" + id);
        $("#delete-modal").modal('show');
    });


    $(document).on("change", ".check-all", function () {
        var childClass = $(this).data("child");
        if ($(this).is(":checked")) {
            $(childClass).prop("checked", true);
        }
    });
</script>
@endsection