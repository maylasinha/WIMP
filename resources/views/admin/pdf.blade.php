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

  <h1 style="margin-bottom: 3rem; font-size: 1.2rem; text-align: center;">Relatório Geral</h1>

  <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem;">Acessos por Sistema Operacional</h3>
  <table cellspacing="0" style="margin-bottom: 3rem; width: 100%;">
    <thead>
      <tr style="background-color: #eee;">
        <th scope="col" style="padding: .5rem; border: 1px solid #000; border-bottom: 0; text-align: left;">Nome</th>
        <th scope="col" style="padding: .5rem; border: 1px solid #000; border-bottom: 0; text-align: left;">Qt</th>
      </tr>
    </thead>
    <tbody>
      @foreach($operating_systems as $key => $operating_system)
        <tr>
          <td width="75%" style="padding: .5rem; border: 1px solid #000; @if(!$loop->last) border-bottom: 0; @endif white-space: nowrap;">{{ $operating_system->name }}</td>
          <td style="padding: .5rem; border: 1px solid #000; @if(!$loop->last) border-bottom: 0; @endif white-space: nowrap;">{{ $visits->where('os', $operating_system->name)->count() }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem;">Usuários por Perfil</h3>
  <table cellspacing="0" style="margin-bottom: 3rem; width: 100%;">
    <thead>
      <tr style="background-color: #eee;">
        <th scope="col" style="padding: .5rem; border: 1px solid #000; border-bottom: 0; text-align: left;">Nome</th>
        <th scope="col" style="padding: .5rem; border: 1px solid #000; border-bottom: 0; text-align: left;">Qt</th>
      </tr>
    </thead>
    <tbody>
      @foreach($roles as $key => $role)
        <tr>
          <td width="75%" style="padding: .5rem; border: 1px solid #000; @if(!$loop->last) border-bottom: 0; @endif white-space: nowrap;">{{ $role->name }}</td>
          <td style="padding: .5rem; border: 1px solid #000; @if(!$loop->last) border-bottom: 0; @endif white-space: nowrap;">{{ $role->users->count() }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem;">Pets por Categoria</h3>
  <table cellspacing="0" style="margin-bottom: 3rem; width: 100%;">
    <thead>
      <tr style="background-color: #eee;">
        <th scope="col" style="padding: .5rem; border: 1px solid #000; border-bottom: 0; text-align: left;">Nome</th>
        <th scope="col" style="padding: .5rem; border: 1px solid #000; border-bottom: 0; text-align: left;">Qt</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pet_categories as $key => $pet_category)
        <tr>
          <td width="75%" style="padding: .5rem; border: 1px solid #000; @if(!$loop->last) border-bottom: 0; @endif white-space: nowrap;">{{ $pet_category->name }}</td>
          <td style="padding: .5rem; border: 1px solid #000; @if(!$loop->last) border-bottom: 0; @endif white-space: nowrap;">{{ $pet_category->pets->count() }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div class="page-break"></div>

  <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem;">Depoimentos por Status</h3>
  <table cellspacing="0" style="margin-bottom: 1rem; width: 100%;">
    <thead>
      <tr style="background-color: #eee;">
        <th scope="col" style="padding: .5rem; border: 1px solid #000; border-bottom: 0; text-align: left;">Nome</th>
        <th scope="col" style="padding: .5rem; border: 1px solid #000; border-bottom: 0; text-align: left;">Qt</th>
      </tr>
    </thead>
    <tbody>
      @foreach($statuses as $key => $status)
        <tr>
          <td width="75%" style="padding: .5rem; border: 1px solid #000; @if(!$loop->last) border-bottom: 0; @endif white-space: nowrap;">{{ $status->name }}</td>
          <td style="padding: .5rem; border: 1px solid #000; @if(!$loop->last) border-bottom: 0; @endif white-space: nowrap;">{{ $testimonials->where('status', $status->status)->count() }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <htmlpagefooter name="page-footer">
    
  </htmlpagefooter>
</body>
</html>