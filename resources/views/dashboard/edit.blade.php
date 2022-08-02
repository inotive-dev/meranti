@extends('layouts.master')

@section('style')
    <style>
        .btn-primary{
            background: #7e2b2c !important;
            border-color: #7e2b2c !important;
        }
        
        .btn-create{
            border-radius: 25px;
            padding: 10px 40px !important;
            font-size: 16px;
            box-shadow: 0px 4px 5px rgba(81, 19, 30, 0.25);
        }
    </style>
@endsection

@section('content')
    <form action="/dashboard/update" method="post">
        <div class="card">
            <div class="card-header text-end">
                @csrf
                <!--<button class="btn btn-success btn-create" type="submit"><i class="fa fa-save align-middle"></i> Simpan</button>-->
                <div class="row">
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-success">
                            <i data-feather="save" class="align-middle"></i>
                            <span class="ms-1 align-middle">Simpan</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <textarea name="description" class="form-control" id="description">{!! $about->description ?? '-' !!}</textarea>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        jQuery(document).ready(function()
        {
            CKEDITOR.replace('description');
        });
    </script>
@endsection