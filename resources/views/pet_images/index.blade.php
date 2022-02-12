@extends('layouts.site')

@section('content')
	<div class="py-5 page pet_images">
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					@include('shared.sidebar_user')
				</div>
				<div class="col-sm-9">
					@include('shared.flash_messages')

					<h6 class="page-title text-truncate text-dark font-weight-medium mb-4 overflow-hidden">
						<a href="{{ route('pets.index') }}">{{ $pet->name }} <i class="fas fa-angle-double-right mx-3"></i></a>
						{{ $title }}
					</h6>

					@if($pet_images->isEmpty())
						<div class="empty">
							<span class="empty__icon"><i class="fas fa-images fa-fw"></i></span>
							<p class="mb-4">Nenhuma imagem de pet cadastrada até o momento.</p>
							<p><a href="{{ route('pets.pet_images.create', $pet->id) }}" class="btn btn-warning px-4"><i class="fas fa-plus fa-fw"></i> Nova Imagem</a></p>
						</div>
					@else
						<div class="table-responsive">
							<table class="table border v-middle">
								<thead class="bg-warning">
									<tr>
										<th>Imagem</th>
										<th colspan="2"></th>
									</tr>
								</thead>
								<tbody>
									@foreach($pet_images as $key => $pet_image)
										<tr>
											<td><img src="{{ !$pet_image->image ? 'https://place-hold.it/1280x300' : Storage::url($pet_image->image) }}" class="img-fluid rounded" style="height: 60px;"></td>
											<td class="text-center"><a href="{{ route('pets.pet_images.edit', [$pet_image->pet->id, $pet_image->id]) }}" class="btn btn-warning btn-sm px-3"><i class="fas fa-edit"></i> Editar</a></td>
											<td class="text-center">
												<form action="{{ route('pets.pet_images.destroy', [$pet_image->pet->id, $pet_image->id]) }}" method="POST">
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
							<span class="empty__icon"><i class="fas fa-images fa-fw"></i></span>
							<p><a href="{{ route('pets.pet_images.create', $pet->id) }}" class="btn btn-warning px-4"><i class="fas fa-plus fa-fw"></i> Nova Imagem</a></p>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection
