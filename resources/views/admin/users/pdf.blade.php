<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <style type="text/css">
    * {
      -webkit-box-sizing: border-box;
         -moz-box-sizing: border-box;
              box-sizing: border-box;
    }

    .page-break {
      page-break-after: always;
    }

    @page {
      header: page-header;
      footer: page-footer;
    }
  </style>
</head>
<body>
  <htmlpageheader name="page-header">
    <div style="padding-top: 2rem; text-align: center;"><img src="{{ asset('img/brand.png') }}" style="width: 175px;"></div>
  </htmlpageheader>

  <h1 style="margin-bottom: 3rem; font-size: 1.2rem; text-align: center;">Dados do Usuário</h1>

  <table style="margin-bottom: 1rem; width: 100%;">
    <tr>
      <td><strong>Nome:</strong> {{ $user->name }}</td>
    </tr>
  </table>

  <table style="margin-bottom: 1rem; width: 100%;">
    <tr>
      <td width="50%"><strong>E-mail:</strong> {{ $user->email }}</td>
      <td width="25%"><strong>Telefone:</strong> {{ !$user->phone ? '--' : phone($user->phone, 'BR')->formatNational() }}</td>
      <td width="25%"><strong>Celular:</strong> {{ !$user->cellphone ? '--' : phone($user->cellphone, 'BR')->formatNational() }}</td>
    </tr>
  </table>

  <table style="margin-bottom: 3rem; width: 100%;">
    <tr>
      <td width="50%"><strong>D. de Nascimento:</strong> {{ !$user->birthdate ? '--' : \Carbon\Carbon::parse($user->birthdate)->format('d/m/Y') }}</td>
      <td width="25%"><strong>Sexo:</strong> {{ !$user->gender ? '--' : \App\Enums\UserGender::getDescription($user->gender) }}</td>
      <td width="25%"><strong>CPF</strong> {{ !$user->cpf ? '--' : mask('###.###.###-##', $user->cpf) }}</td>
    </tr>
  </table>

  @if($user->address)
    <hr style="margin-bottom: 3rem;">

    <table style="margin-bottom: 1rem; width: 100%;">
      <tr>
        <td width="33.33%"><strong>CEP:</strong> {{ $user->address->postal_code }}</td>
        <td width="33.33%"><strong>Logradouro</strong> {{ $user->address->public_place }}</td>
        <td width="33.33%"><strong>Número:</strong> {{ $user->address->street_number }}</td>
      </tr>
    </table>

    <table style="margin-bottom: 1rem; width: 100%;">
      <tr>
        <td><strong>Complemento:</strong> {{ !$user->address->complement ? '--' : $user->address->complement }}</td>
      </tr>
    </table>

    <table style="margin-bottom: 1rem; width: 100%;">
      <tr>
        <td width="75%"><strong>Bairro:</strong> {{ $user->address->neighborhood }}</td>
        <td width="25%"><strong>Cidade/Estado:</strong> {{ $user->address->city->name }} / {{ $user->address->city->state->name }}</td>
      </tr>
    </table>
  @endif

  <htmlpagefooter name="page-footer">
    
  </htmlpagefooter>
</body>
</html>