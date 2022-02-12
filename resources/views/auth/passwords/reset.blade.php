@extends('layouts.site')

@section('content')
<div class="py-5 page reset-password">
  <div class="container">
    <form method="POST" action="{{ route('password.update') }}" class="card m-auto">
      @csrf

      <div class="card-body">
        <legend class="mb-5 text-center">Alterar Senha</legend>

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required placeholder="E-mail" autocomplete="email" autofocus>

          @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Senha" required autocomplete="new-password">

          @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group">
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Senha" required autocomplete="new-password">
        </div>

        <div class="pt-4 text-right">
          <button type="submit" class="btn btn-warning px-4">
            Enviar
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
