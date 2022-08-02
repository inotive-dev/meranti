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
@php
    $userPermissions = [];
    if(Auth::user()->user_role != null)
    {
      $userPermissions = Auth::user()->user_role->role->permissions->pluck('permission_name')->toArray();
    }
@endphp
    <div class="row">
        <div class="col-12 text-end">
            
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 px-3">
            <div class="table-responsive">
                <table class="table">
                <thead>
                    <tr>
                        <th style="width: 50px !important;">No.</th>
                        <th class="">Klien</th>
                        <th class="">Proyek</th>
                        <th class="">Lenght</th>
                        <th class="text-nowrap">Breadth</th>
                        <th class="text-nowrap">Depth</th>
                        <th class="text-nowrap">Klass</th>
                        @if(in_array('read_work_order_item', $userPermissions))
                            <th class="text-nowrap text-end" style="width: 10%">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach($projects as $key => $project)
                        <tr>
                            <td style="width: 50px !important;" class="align-middle">{{ $no++ }}</td>
                            <td class="align-middle">
                                {{ $project->client->name ?? '-' }}
                            </td>
                            <td class="align-middle">
                                {{ $project->name ?? '-' }}
                            </td>
                            <td class="align-middle text-nowrap">{{ $project->length ?? '-' }}</td>
                            <td class="align-middle text-nowrap">{{ $project->breadth ?? '-' }}</td>
                            <td class="align-middle">{{ $project->depth ?? '-' }}</td>
                            <td class="align-middle">{{ $project->klass ?? '-' }}</td>
                            @if(in_array('read_work_order_item', $userPermissions))
                                <td class="text-nowrap">
                                    <a href="{{ route('dashboard.work-order.show', $project->id) }}" class="btn btn-outline-info">
                                      <i data-feather="edit" class="align-middle"></i>
                                      <span class="ms-1 align-middle">Detail</span>
                                    </a>
                                </td>
                            @endif
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
                    <h5 class="modal-title">Hapus Project</h5>
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
            $("#delete-form").attr("action", "{{ route('dashboard.project.index') }}/" + id);
            $("#delete-modal").modal('show');
        });
    </script>
@endsection
