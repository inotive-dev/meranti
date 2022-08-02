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
<form class="" method="post" action="{{ route('dashboard.client.update', $client->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row mt-3">
        <div class="col-12 px-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Edit Client</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Nama <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama client" value="{{ old('name', $client->name) }}" maxlength="100" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan alamat email client" value="{{ old('email', $client->email) }}" maxlength="100" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Telepon <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Masukkan telepon client" value="{{ old('phone', $client->phone) }}" maxlength="100" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Alamat <span class="text-danger">*</span></label>
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Masukkan alamat client" value="{{ $client->address }}" required>{{ old('address', $client->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Logo (<a href="{{ $client->logo }}">Lihat File</a>)</label>
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
