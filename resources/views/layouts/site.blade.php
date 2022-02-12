<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Wimp') }} - {{ @$title }}</title>

	<link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">

	<!-- Scripts -->
	<script type="text/javascript">
		var APP_URL = {!! json_encode(url('/')) !!},
				currentUserId = {!! !auth()->check() ? 0 : auth()->user()->id !!};
	</script>
	<script src="{{ asset('js/scripts.js') }}" defer></script>

	<!-- Styles -->
	<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/site.css') }}" rel="stylesheet">

	<script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<body {!! (Route::current()->getName() == 'root' || Route::current()->getName() == 'home') ? 'class="home"' : NULL !!}>
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v8.0" nonce="MnTEndRn"></script>
	
	<div id="app">
		<div class="wrapper">
			<div class="header">
				<div class="header__top">
					<div class="header__top-left">
						<ul class="header__top-links">
							<li><a href="mailto:{{ $info->email1 }}"><i class="fas fa-envelope fa-fw"></i> {{ $info->email1 }}</a></li>
						</ul>
					</div>
					<div class="header__top-right">
						<ul class="header__top-links">
							<li><a href="{{ $info->facebook }}"><i class="fab fa-facebook fa-fw"></i></a></li>
							<li><a href="{{ $info->instagram }}"><i class="fab fa-instagram fa-fw"></i></a></li>
							<li><a href="{{ $info->youtube }}"><i class="fab fa-youtube fa-fw"></i></a></li>
						</ul>
					</div>
				</div>

				@include('shared.navbar')
			</div>
			<div class="content">
				<main>
					@yield('content')
				</main>
			</div>
			<footer class="footer">
				<div class="container">
					<div class="row">
						<div class="col-sm-4 mb-5">
							<h5 class="line-title mb-5" style="border-bottom: 1px solid #ccc;">
								<span style="background-color: #eee;">Sua Conta</span>
							</h5>
							<ul class="mb-0 list-unstyled text-center">
								<li><a href="{{ route('users.edit') }}">Meus Dados</a></li>
								<li><a href="{{ route('users.edit_password') }}">Alterar Senha</a></li>
								<li><a href="{{ route('pets.index') }}">Meus Pets</a></li>
							</ul>
						</div>

						<div class="col-sm-4 mb-5">
							<h5 class="line-title mb-5" style="border-bottom: 1px solid #ccc;">
								<span style="background-color: #eee;">Fale Conosco</span>
							</h5>
							<ul class="mb-0 list-unstyled text-center">
								<li><a href="{{ route('contact') }}">Contato</a></li>
							</ul>
						</div>

						<div class="col-sm-4">
							<h5 class="line-title mb-5" style="border-bottom: 1px solid #ccc;">
								<span style="background-color: #eee;">Sobre Nós</span>
							</h5>
							<ul class="mb-0 list-unstyled text-center">
								@foreach($pages as $key => $page)
									<li><a href="{{ route('pages.show', $page->slug) }}">{{ $page->title }}</a></li>
								@endforeach
							</ul>
						</div>
					</div>
					<div class="text-center">
						<small class="font-style-italic">{{ \Carbon\Carbon::now()->format('Y') }} - &copy; {{ config('app.name', 'Wimp') }}</small>
					</div>
				</div>
			</footer>
		</div>
	</div>
	
	@include('shared.modal_site')

	@stack('scripts')
</body>
</html>
