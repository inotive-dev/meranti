@extends('layouts.masterAuth')

@section('title')
	{{ $title }}
@endsection

@section('links')

@endsection

@section('style')

@endsection

@section('form-title')
	Form Penyetelan Ulang Password
@endsection

@section('content')
	<form class="form" method="POST" action="/reset-password/{{ $user_id }}">
		@csrf

		<div class="wrap-input100 validate-input" data-validate="Password is required">
			<input class="input100" id="new_password" type="password" maxlength="250" minlength="6" name="password" required>
			<span class="focus-input100"></span>
			<span class="label-input100">Password Baru</span>
		</div>

		<div class="wrap-input100 validate-input" data-validate="Confirmation Password is required">
			<input class="input100" id="confirm_new_password" type="password" maxlength="250" minlength="6" name="password" required>
			<span class="focus-input100"></span>
			<span class="label-input100">Konfirmasi Password</span>
		</div>


	<div class="container-login100-form-btn">
		@csrf
		<button class="login100-form-btn">
			Reset Password
		</button>
	</div>

</form>

@endsection

@section('script')

	<script type="text/javascript">
    var new_password = document.getElementById("new_password")
    , confirm_new_password = document.getElementById("confirm_new_password");

    function validatePassword(){
      if(new_password.value != confirm_new_password.value) {
        confirm_new_password.setCustomValidity("Password Tidak Cocok!");
      } else {
        confirm_new_password.setCustomValidity('');
      }
    }
    new_password.onchange = validatePassword;
    confirm_new_password.onkeyup = validatePassword;
  </script>

@endsection
