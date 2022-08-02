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
gaperlu
@section('content')
<form class="" method="post" action="{{ route('dashboard.user.update', $user->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row mt-3">
        <div class="col-12 px-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Edit Pengguna</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Role <span class="text-danger">*</span></label>
                                <select name="role_id" class="form-control @error('role_id') is-invalid @enderror" required>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ $role->id == $user->user_role->role_id ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Nama <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama pengguna" value="{{ old('name', $user->name) }}" maxlength="100" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan alamat email pengguna" value="{{ old('email', $user->email) }}" maxlength="100" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Jabatan <span class="text-danger">*</span></label>
                                <input type="text" name="position" class="form-control @error('position') is-invalid @enderror" placeholder="Masukkan jabatan" value="{{ old('position', $user->position) }}" maxlength="100" required>
                                @error('position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" placeholder="Masukkan password" value="{{ old('phone') }}" maxlength="100">
                                <div class="invalid-feedback d-block">Kosongkan kolom, jika tidak ingin mengubah password</div>
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
