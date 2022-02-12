<nav class="navbar navbar-expand-md navbar-light py-4" style="border-bottom: 1px solid rgba(255,255,255,.2);">
	<div class="container-fluid">
		<a class="navbar-brand" href="{{ url('/') }}"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
			<span class="navbar-toggler-icon"></span>
		</button>
		
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<!-- Right Side Of Navbar -->
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link text-center mr-4 {{ Route::current()->getName() == 'root' ? 'active' : NULL }}" href="{{ url('/') }}">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-center mx-4 {{ Route::current()->getName() == 'contact' ? 'active' : NULL }}" href="{{ route('contact') }}">Contato</a>
				</li>
				@guest
					<li class="nav-item">
						<a class="nav-link text-center ml-4 {{ Route::current()->getName() == 'login' ? 'active' : NULL }}" href="{{ route('login') }}">Login</a>
					</li>
				@else
					<li class="nav-item dropdown justify-content-center">
						<a id="navbarDropdown" class="nav-link text-center dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							{{ auth()->user()->name }} <span class="caret"></span>
						</a>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="line-height: 32px;">
							<a class="dropdown-item" href="{{ route('users.edit') }}">Dados Pessoais</a>
							<a class="dropdown-item" href="{{ route('users.edit_password') }}">Alterar Senha</a>
							<a class="dropdown-item" href="{{ route('pets.index') }}">Pets</a>
							<a class="dropdown-item" href="{{ route('testimonials.index') }}">Depoimentos</a>
							<a class="dropdown-item" href="{{ route('logout') }}"
								onclick="event.preventDefault();
														 document.getElementById('logout-form').submit();">
								{{ __('Logout') }}
							</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</div>
					</li>
				@endguest
			</ul>
		</div>
	</div>
</nav>