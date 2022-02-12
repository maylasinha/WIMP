@extends('layouts.site')

@section('content')
<div class="py-5 page login">
  <div class="container">
    <form method="POST" action="{{ route('login') }}" class="card m-auto">
      @csrf

      <div class="card-body">
        <legend class="mb-5 text-center">Login</legend>

        <input type="hidden" name="referer" value="{{ url()->previous() }}">

        <div class="mb-3">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-mail" required autocomplete="email" autofocus>

          @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="mb-3">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Senha" required autocomplete="current-password">

          @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="mb-3">
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="custom-control-label" for="remember">
                  {{ __('Lembrar') }}
                </label>
              </div>
            </div>
          </div>

          <div class="col-sm-6 text-right">
            @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}">
                {{ __('Esqueceu sua senha?') }}
              </a>
            @endif
          </div>
        </div>

        <div class="pt-4">
          <button type="submit" class="btn btn-warning w-100 mb-3">
            {{ __('Entrar') }}
          </button>
          <a href="{{ route('redirect') }}" class="btn btn-light border w-100"><i class="fab fa-google mr-1"></i> Entrar com o Google</a>
          <p class="line-title my-4">
            <span class="bg-white">Ou</span>
          </p>
          <a href="{{ route('register') }}" class="btn btn-outline-warning w-100">Criar uma conta</a>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
