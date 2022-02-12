@extends('layouts.site')

@section('content')
	{{-- Carousel --}}
	<div id="carouselExampleIndicators" class="carousel slide border-bottom" data-ride="carousel">
		{{-- <ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
		</ol> --}}

		<div class="carousel-inner">
			<div class="carousel-item active">
				<img src="{{ asset('img/carousel.jpeg') }}" class="d-block w-100" alt="...">
				<div class="carousel-caption d-none d-md-block">
					<h1>Ajudando a encontrar seu animal</h1>
				</div>
			</div>
		</div>

		{{-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a> --}}
	</div>

	{{-- Pets --}}
	<div class="pets py-5">
		<div class="container">
			<h3 class="section-title mb-4">Procura-se</h3>

			@php
				$count = 1;
			@endphp
			@foreach($pets->where('status', '=', '0') as $key => $pet)
				@if($count%3 == 1)
					<div class="row">
				@endif
					<div class="col-md-4">
						<div class="card shadow-sm mb-4">
							@if(!$pet->pet_images)
								<img class="card-img-top" src="https://place-hold.it/1920x1080" alt="{{ $pet->name }}" style="height: 230px;">
							@else
								<div id="carouselPet{{ $pet->id }}" class="carousel slide" data-ride="carousel">
									<div class="carousel-inner">
										@foreach($pet->pet_images as $key => $image)
											<div class="carousel-item {{ $key == 0 ? 'active' : null }}">
												<img src="{{ Storage::url($image->image) }}" class="d-block w-100" alt="{{ $pet->name }}" style="height: 230px; object-fit: cover;" onerror="this.src='https://place-hold.it/1920x1080';">
											</div>
										@endforeach
									</div>

									@if(count($pet->pet_images) > 1)
										<a class="carousel-control-prev" href="#carouselPet{{ $pet->id }}" role="button" data-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="sr-only">Previous</span>
										</a>
										<a class="carousel-control-next" href="#carouselPet{{ $pet->id }}" role="button" data-slide="next">
											<span class="carousel-control-next-icon" aria-hidden="true"></span>
											<span class="sr-only">Next</span>
										</a>
									@endif
								</div>
							@endif
							<div class="card-body pt-4">
								<h4 class="line-title mb-5">
									<span class="bg-white">{{ $pet->name }}</span>
								</h4>

								<div class="row">
									<div class="col-6">
										<ul class="list-group-flush pl-0 mb-0">
											<li class="list-group-item pl-0 font-weight-bold">Dono:</li>
											<li class="list-group-item pl-0 font-weight-bold">Tipo:</li>
											<li class="list-group-item pl-0 font-weight-bold">Sexo:</li>
											<li class="list-group-item pl-0 font-weight-bold">Porte:</li>
											<li class="list-group-item pl-0 font-weight-bold">Raça:</li>
										</ul>
									</div>
									<div class="col-6">
										<ul class="list-group-flush pl-0 mb-0 text-right">
											<li class="list-group-item pl-0" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">{{ $pet->user->name }}</li>
											<li class="list-group-item pl-0">{{ $pet->pet_category->name }}</li>
											<li class="list-group-item pl-0">{{ \App\Enums\PetGender::getDescription($pet->gender) }}</li>
											<li class="list-group-item pl-0">{{ \App\Enums\PetSize::getDescription($pet->size) }}</li>
											<li class="list-group-item pl-0">{{ $pet->breed }}</li>
										</ul>
									</div>
								</div>

								<hr class="my-4">

								<p class="mb-4" style="min-height: 100px;">{{ $pet->description }}</p>

								<a href="#" class="btn btn-light btn-block border list-items" data-toggle="modal" data-target="#modal-list" data-url="{{ route('pets.pet_comments.index', $pet->id) }}" data-title="Comentários sobre {{ $pet->name }}"><i class="fas fa-comments mr-1"></i> Comentários <span class="badge badge-dark">{{ count(!$pet->pet_comments ? [] : $pet->pet_comments) }}</span></a>
							</div>
						</div>
					</div>
				@if($count%3 == 0)
					</div>
				@endif
				@php
					$count++;
				@endphp
			@endforeach
			@if($count%3 != 1)
				</div>
			@endif
		</div>
	</div>

	{{-- Stats --}}
	<div class="stats pb-5">
		<div class="container">
			<h3 class="section-title mb-4">Nós precisamos de sua ajuda</h3>

			<div class="row">
				<div class="col-sm-4">
					<div class="card mb-4 text-center">
						<div class="card-body">
							<img src="{{ asset('img/icon-paw.png') }}" class="img-fluid mb-4">
							<h3>{{ count(!$pets->where('status', '0') ? [] : $pets->where('status', '0')) }}</h3>
							<h6 class="mb-0">Animais Desaparecidos</h6>
						</div>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="card mb-4 text-center">
						<div class="card-body">
							<img src="{{ asset('img/icon-cat.png') }}" class="img-fluid mb-4">
							<h3>{{ count(!$pets->where('status', '1')->where('pet_category_id', '1') ? [] : $pets->where('status', '1')->where('pet_category_id', '1')) }}</h3>
							<h6 class="mb-0">Gatos Encontrados</h6>
						</div>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="card mb-4 text-center">
						<div class="card-body">
							<img src="{{ asset('img/icon-dog.png') }}" class="img-fluid mb-4">
							<h3>{{ count(!$pets->where('status', '1')->where('pet_category_id', '2') ? [] : $pets->where('status', '1')->where('pet_category_id', '2')) }}</h3>
							<h6 class="mb-0">Cachorros Encontrados</h6>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- Testimonials --}}
	<div class="testimonials pb-5">
		<div class="container">
			<h3 class="section-title mb-4">Depoimentos</h3>

			<div class="testimonials__slide">
				@foreach($testimonials as $key => $testimonial)
					<div>
						<div class="card mx-auto w-75">
							<div class="card-body">
								<img src="{{ asset('img/quote-left.png') }}" class="img-fluid mb-4">
								<h4 class="mb-4 text-center">{{ $testimonial->description }}</h4>
								<p class="mb-4 text-center font-weight-bold">{{ $testimonial->user->name }}</p>
								<div class="text-right">
									<img src="{{ asset('img/quote-right.png') }}" class="img-fluid">
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
@endsection
