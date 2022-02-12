@extends('layouts.site')

@section('content')
<div class="py-5 page reset-password">
  <div class="container">
    <form method="POST" action="{{ route('password.email') }}" class="card m-auto">
      @csrf
      
      <div class="card-body">
        <legend class="mb-5 text-center">Recuperar Senha</legend>

        @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
        @endif

        <div class="form-group">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-mail" required autocomplete="email" autofocus>

          @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="pt-4 text-right">
          <button type="submit" class="btn btn-warning px-4">Recuperar Senha</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
