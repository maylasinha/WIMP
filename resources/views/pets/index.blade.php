@extends('layouts.site')

@section('content')
	<div class="py-5 page pets">
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					@include('shared.sidebar_user')
				</div>
				<div class="col-sm-9">
					@include('shared.flash_messages')

					@if($pets->isEmpty())
						<div class="empty">
							<span class="empty__icon"><i class="fas fa-paw fa-fw"></i></span>
							<p class="mb-4">Nenhum pet cadastrado até o momento.</p>
							<p><a href="{{ route('pets.create') }}" class="btn btn-warning px-4"><i class="fas fa-plus fa-fw"></i> Novo Pet</a></p>
						</div>
					@else
						<div class="table-responsive">
							<table class="table border v-middle">
								<thead class="bg-warning">
									<tr>
										<th>Nome</th>
										<th>Categoria</th>
										<th>Sexo</th>
										<th>Porte</th>
										<th>Encontrado</th>
										<th colspan="3"></th>
									</tr>
								</thead>
								<tbody>
									@foreach($pets as $key => $pet)
										<tr>
											<td>{{ $pet->name }}</td>
											<td>{{ $pet->pet_category->name }}</td>
											<td>{{ \App\Enums\PetGender::getDescription($pet->gender) }}</td>
											<td>{{ \App\Enums\PetSize::getDescription($pet->size) }}</td>
											<td>
												<label class="form-switch" onchange="updateStatus(this, event)" data-token="{{ csrf_token() }}" data-controller="pets" data-id="{{ $pet->id }}">
													<input type="checkbox" name="status" id="pet_{{ $pet->id }}" tabindex="1" {{ !$pet->status ? 'value=1' : 'value=0 checked' }}>
													<i></i>
												</label>
											</td>
											<td class="text-center"><a href="{{ route('pets.pet_images.index', $pet->id) }}" class="btn btn-light btn-sm px-3 border"><i class="fas fa-images"></i> Imagens</a></td>
											<td class="text-center"><a href="{{ route('pets.edit', $pet->id) }}" class="btn btn-warning btn-sm px-3"><i class="fas fa-edit fa-fw" aria-hidden="true"></i> Editar</a></td>
											<td class="text-center">
												<form action="{{ route('pets.destroy', $pet->id) }}" method="POST">
													{{ csrf_field() }}
													{{ method_field('DELETE') }}
													<button type="submit" class="btn btn-danger btn-sm px-3"><i class="fa fa-times fa-fw" aria-hidden="true"></i> Apagar</button>
												</form>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<div class="empty pt-4">
							<span class="empty__icon"><i class="fas fa-paw fa-fw"></i></span>
							<p><a href="{{ route('pets.create') }}" class="btn btn-warning px-4"><i class="fas fa-plus fa-fw"></i> Novo Pet</a></p>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection
