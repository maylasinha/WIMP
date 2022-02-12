<span class="badge badge-secondary">Nome</span>
<p>{{ $user->name }}</p>

<div class="row">
	<div class="col-sm-6">
		<span class="badge badge-secondary">E-mail</span>
		<p>{{ $user->email }}</p>
	</div>
	<div class="col-sm-3">
		<span class="badge badge-secondary">Telefone</span>
		<p>{{ !$user->phone ? NULL : phone($user->phone, 'BR')->formatNational() }}</p>
	</div>
	<div class="col-sm-3">
		<span class="badge badge-secondary">Celular</span>
		<p>{{ !$user->cellphone ? NULL : phone($user->cellphone, 'BR')->formatNational() }}</p>
	</div>
</div>

<div class="row">
	<div class="col-sm-6">
		<span class="badge badge-secondary">Data de Nascimento</span>
		<p>{{ !$user->birthdate ? NULL : \Carbon\Carbon::parse($user->birthdate)->format('d/m/Y') }}</p>
	</div>
	<div class="col-sm-3">
		<span class="badge badge-secondary">Sexo</span>
		<p>{{ !$user->gender ? NULL : \App\Enums\UserGender::getDescription($user->gender) }}</p>
	</div>
	<div class="col-sm-3">
		<span class="badge badge-secondary">CPF</span>
		<p>{{ !$user->cpf ? NULL : mask('###.###.###-##', $user->cpf) }}</p>
	</div>
</div>

@if($user->address)
	<!-- Endereço -->
	<h5 class="section-title my-4">
		<span>Endereço</span>
	</h5>

	<div class="row">
		<div class="col-sm-3">
			<span class="badge badge-secondary">CEP</span>
			<p>{{ mask('#####-###', $user->address->postal_code) }}</p>
		</div>
		<div class="col-sm-7">
			<span class="badge badge-secondary">Logradouro</span>
			<p>{{ $user->address->public_place }}</p>
		</div>
		<div class="col-sm-2">
			<span class="badge badge-secondary">Número</span>
			<p>{{ $user->address->street_number }}</p>
		</div>
	</div>

	@if($user->address->complement)
		<span class="badge badge-secondary">Complemento</span>
		<p>{{ $user->address->complement }}</p>
	@endif

	<div class="row">
		<div class="col-sm-6">
			<span class="badge badge-secondary">Bairro</span>
			<p>{{ $user->address->neighborhood }}</p>
		</div>
		<div class="col-sm-6">
			<span class="badge badge-secondary">Cidade/Estado</span>
			<p>{{ $user->address->city->name }} / {{ $user->address->city->state->name }}</p>
		</div>
	</div>
@endif

<hr>

<a href="{{ route('admin.users.pdf', $user->id) }}" class="btn btn-danger btn-sm px-3"><i class="fas fa-file-pdf mr-1"></i> PDF</a>
