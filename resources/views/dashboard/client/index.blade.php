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

@section('content')
    <div class="row">
        <div class="col-12 text-end">
            <a href="{{ route('dashboard.client.create') }}" class="btn btn-primary btn-create">
                <i data-feather="plus" class="align-middle"></i>
                <span class="ms-1 align-middle">Tambah</span>
            </a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 px-3">
            <div class="table-responsive">
                <table class="table">
                <thead>
                    <tr>
                        <th style="width: 50px !important;">No.</th>
                        <th class="">Logo</th>
                        <th class="">Nama</th>
                        <th class="text-nowrap">Email</th>
                        <th class="text-nowrap">Telepon</th>
                        <th class="text-nowrap">Alamat</th>
                        <th class="text-nowrap text-end" style="width: 10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach($clients as $key => $client)
                        <tr>
                            <td style="width: 50px !important;" class="align-middle">{{ $no++ }}</td>
                            <td class="align-middle">
                                <img src="{{ $client->logo ?? '-' }}" width="64px">
                            </td>
                            <td class="align-middle">
                                {{ $client->name ?? '-' }}
                            </td>
                            <td class="align-middle text-nowrap">{{ $client->email ?? '-' }}</td>
                            <td class="align-middle text-nowrap">{{ $client->phone ?? '-' }}</td>
                            <td class="align-middle">{{ $client->address ?? '-' }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('dashboard.client.edit', $client->id) }}" class="btn btn-outline-primary">
                                    <i data-feather="edit" class="align-middle"></i>
                                    <span class="ms-1 align-middle">Edit</span>
                                </a>
                                <button class="btn btn-outline-danger btn-delete" value="{{ $client->id }}">
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

    <div class="modal fade" tabindex="-1" role="dialog" id="delete-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Client</h5>
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
        // delete events
        $(document).on("click", ".btn-delete", function()
        {
            var id = $(this).val();
            $("#delete-form").attr("action", "{{ route('dashboard.client.index') }}/" + id);
            $("#delete-modal").modal('show');
        });
    </script>
@endsection
