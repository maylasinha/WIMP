@extends('layouts.site')

@section('content')
	<div class="py-5 page contact">
		<div class="container">
      <h3 class="section-title mb-4">{{ @$title }}</h3>
      
      <div class="row">
        <div class="col-sm-4 text-center">
          <p class="mb-4 text-justify font-italic">Entre em contato conosco preenchendo o formulário ao lado</p>
        </div>
        <div class="col-sm-8">
          @include('shared.flash_messages')

          <div class="card shadow-sm">
            <div class="card-body">
              <form action="{{ route('contact') }}" method="post">
                @csrf

                <div class="form-group">
                  <input type="text" name="name" class="form-control" placeholder="Nome *" required>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input type="email" name="email" class="form-control" placeholder="E-mail *" required>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <input type="text" name="phone" class="form-control phone" placeholder="Telefone">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <input type="text" name="cellphone" class="form-control cellphone" placeholder="Celular *" required>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <textarea name="body" class="form-control" rows="6" placeholder="Mensagem *" required></textarea>
                </div>

                {{-- <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY', 'default_value') }}" data-callback="enableSubmit" data-expired-callback="disableSubmit" style="transform: scale(0.9); transform-origin: 0 0"></div> --}}

                <div class="pt-5 text-right">
                  <button type="submit" class="btn btn-warning px-5"><i class="fas fa-check fa-fw"></i> Enviar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
		</div>
	</div>
@endsection