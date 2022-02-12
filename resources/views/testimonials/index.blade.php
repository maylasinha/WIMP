@extends('layouts.site')

@section('content')
	<div class="py-5 page testimonials">
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					@include('shared.sidebar_user')
				</div>
				<div class="col-sm-9">
					@include('shared.flash_messages')

					@if($testimonials->isEmpty())
						<div class="empty">
							<span class="empty__icon"><i class="fas fa-comments fa-fw"></i></span>
							<p class="mb-4">Nenhum depoimento cadastrado até o momento.</p>
							<p><a href="{{ route('testimonials.create') }}" class="btn btn-warning px-4"><i class="fas fa-plus fa-fw"></i> Novo Depoimento</a></p>
						</div>
					@else
						<div class="table-responsive">
							<table class="table border v-middle">
								<thead class="bg-warning">
									<tr>
										<th>Criado em</th>
										<th>Status</th>
										<th colspan="3"></th>
									</tr>
								</thead>
								<tbody>
									@foreach($testimonials as $key => $testimonial)
										<tr>
											<td>{{ \Carbon\Carbon::parse($testimonial->created_at)->format('d/m/Y').' - '.\Carbon\Carbon::parse($testimonial->created_at)->format('H:i') }}</td>
											<td>{{ !$testimonial->status ? 'Aguardando aprovação' : 'Aprovado' }}</td>
											@if(!$testimonial->status)
												<td class="text-center"><a href="{{ route('testimonials.edit', $testimonial->id) }}" class="btn btn-warning btn-sm px-3"><i class="fas fa-edit fa-fw" aria-hidden="true"></i> Editar</a></td>
												<td class="text-center">
													<form action="{{ route('testimonials.destroy', $testimonial->id) }}" method="POST">
														{{ csrf_field() }}
														{{ method_field('DELETE') }}
														<button type="submit" class="btn btn-danger btn-sm px-3"><i class="fa fa-times fa-fw" aria-hidden="true"></i> Apagar</button>
													</form>
												</td>
											@else
												<td class="text-center"></td>
												<td class="text-center"></td>
											@endif
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<div class="empty pt-4">
							<span class="empty__icon"><i class="fas fa-comments fa-fw"></i></span>
							<p><a href="{{ route('testimonials.create') }}" class="btn btn-warning px-4"><i class="fas fa-plus fa-fw"></i> Novo Depoimento</a></p>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection
