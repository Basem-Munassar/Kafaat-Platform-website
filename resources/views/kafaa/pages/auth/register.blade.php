<!doctype html>
<html class="no-js" lang="">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>register admin</title>
	<meta name="description" content="admin panel">
	<meta name=”robots” content="index, follow">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="msapplication-TileColor" content="#2b5797">
	<meta name="theme-color" content="#ffffff">
	<!-- Place favicon.ico in the root directory -->
	<link rel="stylesheet" href="{{ asset('admin/css/normalize.css') }}">
	<link href="{{ asset('admin/css/fontawsome/all.min.css') }}" rel="stylesheet">
	<link rel="stylesheet"
		href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css"
		integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
		integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	<link rel="stylesheet" href="{{ asset('admin/css/main.css') }}">
</head>

<body class="gradient auth-page">

	<div class="bmd-layout-container bmd-drawer-f-l avam-container animated ">
		<main class="bmd-layout-content">
			<div class="container-fluid">
				<div class="main_wrapper">                    
<!-- form -->

<div class="row ">
    <div class="col-md-6 col-lg-5 card shade mw-center mh-center auth-card">
        <div class="auth-card__header text-center">
            {{-- <img src="{{ asset('') }}" alt="Logo" class="auth-logo mb-3" height="110" width="260"> --}}
            <h2>إنشاء حساب</h2>
            <p class="auth-subtitle">سجل بياناتك لتصبح جزءًا من لوحة التحكم وتمكن من الوصول إلى كل المميزات.</p>
        </div>
        <hr class="hr-dashed m-0 mb-4">
        <form action="{{ route('auth.store') }}" method="POST" class="auth-form" enctype="multipart/form-data">
			@csrf
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			<div class="form-group">
				<label for="userName">الاسم</label>
				<input type="text" name="name" class="form-control" id="userName"
					placeholder="باسم" value="{{ old('name') }}">
			</div>
			@error('name')
				<small class="text-danger">{{ $message }}</small>
			@enderror

			<div class="form-group">
				<label for="email">البريد الإلكتروني</label>
				<input type="email" name="email" class="form-control" id="email"
					placeholder="example@gmail.com" value="{{ old('email') }}">
			</div>
			@error('email')
				<small class="text-danger">{{ $message }}</small>
			@enderror

			<div class="form-group">
				<label for="account_type">نوع الحساب</label>
				<select name="account_type" class="form-control" id="account_type">
					<option value="user" {{ old('account_type') == 'user' ? 'selected' : '' }}>مستخدم عادي يبحث عن موظفين</option>
					<option value="employee" {{ old('account_type') == 'employee' ? 'selected' : '' }}>موظف يبحث عن عمل</option>
				</select>
			</div>
			@error('account_type')
				<small class="text-danger">{{ $message }}</small>
			@enderror

			<div class="row">
				<div class="form-group col-md-6">
					<label for="password">كلمة المرور</label>
					<input type="password" name="password" class="form-control" id="password" placeholder="كلمة المرور">
					@error('password')
						<small class="text-danger">{{ $message }}</small>
					@enderror
				</div>
				<div class="form-group col-md-6">
					<label for="password_confirmation">تأكيد كلمة المرور</label>
					<input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="تأكيد كلمة المرور">
					@error('password_confirmation')
						<small class="text-danger">{{ $message }}</small>
					@enderror
				</div>
			</div>

			<div class="form-group">
				<label for="location">الموقع</label>
				<input type="text" name="location" class="form-control" id="location"
					placeholder="صنعاء، اليمن" value="{{ old('location') }}">
			</div>
			@error('location')
				<small class="text-danger">{{ $message }}</small>
			@enderror

			<button type="submit" class="btn auth-btn btn-block">إنشاء حساب</button>
		</form>
		<p class="auth-note">لديك حساب بالفعل؟ <a href="{{ route('auth.login') }}">تسجيل دخول</a></p>
    </div>

</div>
<!--  -->


				</div>

			</div>
		</main>
	</div>

	</div>

	<script src="{{ asset('admin/js/vendor/modernizr.js') }}"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"
		integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	<script>
		window.jQuery || document.write('<script src="{{ asset('admin/js/vendor/jquery-3.2.1.min.js') }}"><\/script>');
	</script>
	<script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js"
		integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous">
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js"
		integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous">
	</script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
	<script>
		$(document).ready(function () {
			$('body').bootstrapMaterialDesign();
		});
	</script>
	<script src="{{ asset('admin/js/main.js') }}"></script>

</body>

</html>

