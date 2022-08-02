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
<form class="" method="post" action="{{ route('dashboard.client.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row mt-3">
        <div class="col-12 px-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Tambah Client</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Nama <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama client" value="{{ old('name') }}" maxlength="100" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan alamat email client" value="{{ old('email') }}" maxlength="100" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Telepon <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Masukkan telepon client" value="{{ old('phone') }}" maxlength="100" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Alamat <span class="text-danger">*</span></label>
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Masukkan alamat client" value="{{ old('address') }}" required>{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Role <span class="text-danger">*</span></label>
                                <select name="role_id" class="form-control @error('role_id') is-invalid @enderror" required>
                                    <option value="" hidden>Pilih</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" placeholder="Masukkan password" value="{{ old('phone') }}" maxlength="100" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Logo<span class="text-danger">*</span></label>
                                <div class="form-control-file btn-input-image"><span class="label-create-input-image">Upload File</span></div>
                                <input type="file" name="file" class="d-none create-input-image" accept="image/*">
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
