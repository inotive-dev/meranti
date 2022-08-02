@extends('layouts.masterAuth')

@section('title')
	{{ $title }}
@endsection

@section('links')

@endsection

@section('style')

@endsection

@section('form-title')
	Login Untuk Melanjutkan
@endsection

@section('content')
	<form class="validate-form" method="POST" action="{{ route('login') }}">

		<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
			<input class="input100" type="text" name="email">
			<span class="focus-input100"></span>
			<span class="label-input100">Email</span>
		</div>


		<div class="wrap-input100 validate-input" data-validate="Password is required">
			<input class="input100" type="password" name="password">
			<span class="focus-input100"></span>
			<span class="label-input100">Kata Sandi</span>
		</div>


		<div class="flex-sb-m w-full p-t-3 p-b-32">
			<div class="contact100-form-checkbox">
				<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
				<label class="label-checkbox100" for="ckb1">
					Ingat saya
				</label>
			</div>

		<div class="contact100-form-checkbox">
			<span class="txt2">
				<a href="#" id="tombolForgetPassword" class="t-p">Lupa Password?</a>
			</span>
		</div>
	</div>


	<div class="container-login100-form-btn">
		@csrf
		<button class="login100-form-btn">
			Login
		</button>
	</div>

</form>

<!-- MODAL FORGOT PASSWORD -->
<div class="modal fade" id="modalForgetPassword">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"> <b>Pengajuan Reset Password</b> </h5>
				<button class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('forgetPassword') }}" method="post">
					@csrf

					<div class="wrap-input100">
						<input class="input100" type="text" name="email" autofocus required>
						<span class="focus-input100"></span>
						<span class="label-input100">Email</span>
					</div>
					<small class="form-text mb-3">Kami akan mengirim link penyetelan ulang password ke alamat email anda</small>

					<div class="form-group">
						<button type="submit" class="btn btn-block btn-p">Kirim</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- ENDMODAL -->

@endsection

@section('script')

	<script type="text/javascript">
		$("#tombolForgetPassword").on("click", function(){
			$("#modalForgetPassword").modal();
		});
	</script>

@endsection
