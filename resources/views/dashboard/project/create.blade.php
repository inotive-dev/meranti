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
<form class="" method="post" action="{{ route('dashboard.project.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row mt-3">
        <div class="col-12 px-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Tambah Proyek</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Klien<span class="text-danger">*</span></label>
                                <select name="client_id" class="form-control @error('client_id') is-invalid @enderror" required>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                                @error('client_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Nama Proyek<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama proyek" value="{{ old('name') }}" maxlength="100" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Length <span class="text-danger">*</span></label>
                                <input type="text" name="length" class="form-control @error('length') is-invalid @enderror" placeholder="Masukkan length" value="{{ old('length') }}" maxlength="100" required>
                                @error('length')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Breadth <span class="text-danger">*</span></label>
                                <input type="text" name="breadth" class="form-control @error('breadth') is-invalid @enderror" placeholder="Masukkan breadth" value="{{ old('breadth') }}" maxlength="100" required>
                                @error('breadth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Depth <span class="text-danger">*</span></label>
                                <input type="text" name="depth" class="form-control @error('depth') is-invalid @enderror" placeholder="Masukkan depth" value="{{ old('depth') }}" maxlength="100" required>
                                @error('depth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Klass <span class="text-danger">*</span></label>
                                <input type="text" name="klass" class="form-control @error('klass') is-invalid @enderror" placeholder="Masukkan klass" value="{{ old('klass') }}" maxlength="100" required>
                                @error('klass')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <div class="mb-3">
                                <label>Deskripsi</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Masukkan deskripsi" value="{{ old('description') }}">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <div class="mb-3 mt-3 text-end">
                                <button type="submit" class="btn btn-p">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
<script>
    $('.btn-input-image').on('click', function(){
        $('.create-input-image').click();
    });
    
    $(".create-input-image").on('change', function(){
        $('.form-control-file').css('background', '#dd465f');
        $('.form-control-file').css('color', 'white');
        $('.form-control-file').css('box-shadow', '0px 4px 0px #dd465f');
        $('.label-create-input-image').text('Ganti File');
        $('.select-category').attr('readonly', true);
    });
</script>
@endsection
