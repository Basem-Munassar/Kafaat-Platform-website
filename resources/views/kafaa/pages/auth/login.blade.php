<!doctype html>
<html class="no-js" lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Login admin</title>
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
<div class="row justify-content-center">
    <div class="col-md-5 card shade mw-center mh-center auth-card">
        <div class="auth-card__header text-center">
            {{-- <img src="{{ asset('') }}" alt="Logo" class="auth-logo mb-3" height="110" width="260"> --}}
            <h2>تسجيل الدخول</h2>
            <p class="auth-subtitle">سجل دخولك للوصول إلى لوحة التحكم وإدارة المحتوى بسهولة.</p>
        </div>
        <hr class="hr-dashed m-0 mb-4">
        <form action="{{ route('auth.check') }}" method="POST" class="auth-form">
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
            <div class="form-group m-0">
                <label for="exampleInputEmail1">البريد الإلكتروني</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="example@gmail.com">
                <small id="emailHelp" class="form-text text-muted">لن نشارك بريدك مع أي جهة.</small>
            </div>
			@error('email')
				<small class="text-danger">{{ $message }}</small>
			@enderror   
            <div class="form-group m-0">
                <label for="exampleInputPassword1">كلمة المرور</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                    placeholder="كلمة المرور">
            </div>
			@error('password')
				<small class="text-danger">{{ $message }}</small>
			@enderror   
            {{-- <div class="form-check pt-2">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> --}}
            <button type="submit" class="btn auth-btn btn-block">دخول</button>
        </form>
		<p>Don't you have an acount? <a href="{{ route('auth.register') }}">register</a></p>

    </div>
</div>
<!--  -->
				</div>

			</div>
		</main>
	</div>

	</div>



	<script src="{{  asset('admin/js/vendor/modernizr.js')}}"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"
		integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	<script>
		window.jQuery || document.write('<script src="{{ asset('admin/js/vendor/jquery-3.2.1.min.js') }}"><\/script>')
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

