<legend class="mb-5 text-center">{{ $title }}</legend>

@include('shared.errors')

<div class="form-group">
  <input type="text" name="name" value="{{ old('name') ? old('name') : @$user->name }}" class="form-control" placeholder="* Nome" required>
</div>

<div class="form-group">
  <input type="email" name="email" value="{{ old('email') ? old('email') : @$user->email }}" class="form-control" placeholder="* E-mail" required autocomplete="email" autofocus>
</div>

<div class="row">
  <div class="col-sm-4">
    <div class="form-group">
      <input type="text" name="cpf" value="{{ old('cpf') ? old('cpf') : @$user->cpf }}" class="form-control cpf" placeholder="* CPF">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <input type="text" name="phone" value="{{ old('phone') ? old('phone') : @$user->phone }}" class="form-control phone" placeholder="Telefone">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <input type="text" name="cellphone" value="{{ old('cellphone') ? old('cellphone') : @$user->cellphone }}" class="form-control cellphone" placeholder="* Celular" required>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <select name="gender" class="form-control" required>
        <option value="">Selecione</option>
        @foreach(range(0, 2) as $option)
          <option value="{{ $option }}" {{ @$user->gender == $option ? 'selected' : NULL }}>{{ \App\Enums\UserGender::getDescription($option) }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <input type="text" name="birthdate" value="{{ old('birthdate') ? old('birthdate') : (!@$user->birthdate ? NULL : \Carbon\Carbon::parse(@$user->birthdate)->format('d/m/Y')) }}" class="form-control date" placeholder="* Data de Nascimento" required>
    </div>
  </div>
</div>

<hr class="my-5">

<div class="form-group inner-addon right-addon">
  <input type="text" name="postal_code" value="{{ old('postal_code') ? old('postal_code') : @$user->address->postal_code }}" class="form-control postal_code" placeholder="* CEP" onkeyup="getLocation(this, event)" required>
</div>

<div class="form-group">
  <input type="text" name="public_place" value="{{ old('public_place') ? old('public_place') : @$user->address->public_place }}" class="form-control" placeholder="* Endereço" required>
</div>

<div class="row">
  <div class="col-sm-4">
    <div class="form-group">
      <input type="text" name="street_number" value="{{ old('street_number') ? old('street_number') : @$user->address->street_number }}" class="form-control" placeholder="* Número" required>
    </div>
  </div>
  <div class="col-sm-8">
    <div class="form-group">
      <input type="text" name="neighborhood" value="{{ old('neighborhood') ? old('neighborhood') : @$user->address->neighborhood }}" class="form-control" placeholder="* Bairro" required>
    </div>
  </div>
</div>

<div class="form-group">
  <input type="text" name="complement" value="{{ old('complement') ? old('complement') : @$user->address->complement }}" class="form-control" placeholder="* Complemento" required>
</div>

<div class="row">
  <div class="col-sm-6">
    <div class="form-group mb-0">
      <select name="state_id" class="form-control" required>
        @foreach($states as $option)
          <option value="{{ $option->id }}" data-uf="{{ $option->abbreviation }}" {{ old('state_id') == $option->id || @$user->address->city->state->id == $option->id ? 'selected' : NULL }}>{{ $option->name }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group mn-0">
      <select name="city_id" class="form-control" data-current="{{ old('city_id') ? old('city_id') : @$user->address->city->id }}" required></select>
    </div>
  </div>
</div>

<div class="pt-5 text-right">
  <button type="submit" class="btn btn-warning px-5 float-right"><i class="fas fa-check fa-fw"></i> Salvar</button>
</div>

@push('scripts')
  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
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