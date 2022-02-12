@extends('layouts.site')

@section('content')
<div class="py-5 page register">
  <div class="container">
    <form method="POST" action="{{ route('register') }}" class="card m-auto form-step">
      @csrf

      <div class="card-body">
        <legend class="mb-5 text-center">Crie sua conta gratuita</legend>

        <fieldset>
          <div class="form-group">
            <input type="text" name="name" value="{{ old('name') ? old('name') : NULL }}" class="form-control" placeholder="* Nome" required autofocus>
          
            @error('name')
              <span class="invalid-feedback" role="alert">
                <strong>{!! $message !!}</strong>
              </span>
            @enderror
          </div>
          <div class="form-group">
            <input type="email" name="email" value="{{ old('email') ? old('email') : NULL }}" class="form-control @error('email') is-invalid @enderror" placeholder="* E-mail" required autocomplete="email">
            
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{!! $message !!}</strong>
              </span>
            @enderror
          </div>
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <input type="text" name="cellphone" value="{{ old('cellphone') ? old('cellphone') : NULL }}" class="form-control cellphone @error('cellphone') is-invalid @enderror" placeholder="* Celular" required>
                
                  @error('cellphone')
                    <span class="invalid-feedback" role="alert">
                      <strong>{!! $message !!}</strong>
                    </span>
                  @enderror
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <input type="text" name="cpf" value="{{ old('cpf') ? old('cpf') : NULL }}" class="form-control cpf @error('cpf') is-invalid @enderror" placeholder="* CPF" required>
              
                @error('cpf')
                  <span class="invalid-feedback" role="alert">
                    <strong>{!! $message !!}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-4">
               <div class="form-group">
                <input type="text" name="birthdate" value="{{ old('birthdate') ? old('birthdate') : NULL }}" class="form-control date @error('birthdate') is-invalid @enderror" placeholder="* D. de Nascimento" required>
              
                @error('birthdate')
                  <span class="invalid-feedback" role="alert">
                    <strong>{!! $message !!}</strong>
                  </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="form-group">
            <input type="password" name="password" value="{{ old('password') ? old('password') : NULL }}" class="form-control @error('password') is-invalid @enderror" placeholder="* Senha" required>
            
            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{!! $message !!}</strong>
              </span>
            @else
              <small id="passwordHelp" class="form-text text-muted">Mínimo de 8 caracteres.</small>
            @enderror
          </div>
          <div class="form-group">
            <input type="password" name="password_confirmation" value="{{ old('password_confirmation') ? old('password_confirmation') : NULL }}" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="* Confirmar Senha" required>
          
            @error('password_confirmation')
              <span class="invalid-feedback" role="alert">
                <strong>{!! $message !!}</strong>
              </span>
            @enderror
          </div>

          <div class="pt-4">
            <button type="button" class="btn btn-warning btn-block btn-next"><i class="fas fa-angle-double-right fa-fw"></i> Próximo</button>
          </div>
        </fieldset>
          
        <fieldset style="display: none;">
          <div class="form-group inner-addon right-addon">
            <input type="text" name="postal_code" value="{{ old('postal_code') ? old('postal_code') : NULL }}" class="form-control postal_code @error('postal_code') is-invalid @enderror" placeholder="* CEP" onkeyup="getLocation(this, event)" required>
          
            @error('postal_code')
              <span class="invalid-feedback" role="alert">
                <strong>{!! $message !!}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group">
            <input type="text" name="public_place" value="{{ old('public_place') ? old('public_place') : NULL }}" class="form-control @error('public_place') is-invalid @enderror" placeholder="* Endereço" required>
          
            @error('public_place')
              <span class="invalid-feedback" role="alert">
                <strong>{!! $message !!}</strong>
              </span>
            @enderror
          </div>

          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <input type="text" name="street_number" value="{{ old('street_number') ? old('street_number') : NULL }}" class="form-control @error('street_number') is-invalid @enderror" placeholder="* Número" required>
              
                @error('street_number')
                  <span class="invalid-feedback" role="alert">
                    <strong>{!! $message !!}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-8">
              <div class="form-group">
                <input type="text" name="neighborhood" value="{{ old('neighborhood') ? old('neighborhood') : NULL }}" class="form-control @error('neighborhood') is-invalid @enderror" placeholder="* Bairro" required>
              
                @error('neighborhood')
                  <span class="invalid-feedback" role="alert">
                    <strong>{!! $message !!}</strong>
                  </span>
                @enderror
              </div>
            </div>
          </div>

          <div class="form-group">
            <input type="text" name="complement" value="{{ old('complement') ? old('complement') : NULL }}" class="form-control @error('complement') is-invalid @enderror" placeholder="* Complemento" required>
          
            @error('complement')
              <span class="invalid-feedback" role="alert">
                <strong>{!! $message !!}</strong>
              </span>
            @enderror
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <select name="state_id" class="form-control" required>
                  @foreach($states as $option)
                    <option value="{{ $option->id }}" data-uf="{{ $option->abbreviation }}" {{ old('state_id') == $option->id || @$user->name->address->city->state->id == $option->id ? 'selected' : NULL }}>{{ $option->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <select name="city_id" class="form-control" data-current="{{ old('city_id') ? old('city_id') : @$user->city->id }}" required></select>
              </div>
            </div>
          </div>

          <div class="pt-4">
            <button type="submit" class="btn btn-warning btn-block"><i class="fas fa-check fa-fw"></i> Criar minha conta</button>
          </div>
        </fieldset>
      </div>
    </form>
  </div>
</div>

@push('scripts')
  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
      $(document).on('change', 'input[name="birthdate"]', function(e) {
        var birthdate = $(this).val(),
            age = moment().diff(moment(birthdate, 'DD/MM/YYYY').format('YYYY-MM-DD'), 'years');

        if(age < 18) {
          $(this).parents('fieldset').find('.btn-next').attr('disabled', true);
          notify('<i class="fas fa-check fa-fw"></i> Caadastro não permitido para menores de 18 anos.', 'warning');
        } else {
          $(this).parents('fieldset').find('.btn-next').removeAttr('disabled');
        }
      });

      $(document).on('change', 'select[name="state_id"]', function(e) {
        var id = $(this).val(),
            select = $('select[name="city_id"]'),
            current = select.data('current');

        $.ajax({
          url: APP_URL + '/states/cities/' + id,
          type: 'GET',
          success: function(result) {
            select.empty();
            $.each(result, function(index, el) {
              if (el.id == current) {
                select.append('<option value="' + el.id + '" selected>' + el.name + '</option>');
              } else {
                select.append('<option value="' + el.id + '">' + el.name + '</option>');
              }
            });
          },
          error: function(xhr) {
            
          }
        });
      });

      $('select[name="state_id"]').trigger('change');
    });
  </script>
@endpush

@endsection
