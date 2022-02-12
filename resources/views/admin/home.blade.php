@extends('layouts.dashboard')

@section('content')

<div class="page-breadcrumb">
	<h4 class="page-title text-truncate text-dark font-weight-medium mb-1 overflow-hidden">
		{{ $title }}

		<a href="{{ route('admin.reports.pdf') }}" class="btn btn-danger btn-sm px-3 float-right"><i class="fas fa-file-pdf mr-1"></i> Relatório</a>
	</h4>
</div>

<div class="container-fluid">
	<div class="row mb-4">
		<div class="col-sm-3">
			<div class="card shadow-sm" style="border-left: 3px solid #333;">
				<div class="card-body" style="min-height: 110px;">
					<p>Total de Acessos</p>
					<h3 id="visits" class="mb-0 text-center loader"></h3>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="card shadow-sm" style="border-left: 3px solid #333;">
				<div class="card-body" style="min-height: 110px;">
					<p>Total de Usuários</p>
					<h3 id="users" class="mb-0 text-center loader"></h3>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="card shadow-sm" style="border-left: 3px solid #333;">
				<div class="card-body" style="min-height: 110px;">
					<p>Total de Pets</p>
					<h3 id="pets" class="mb-0 text-center loader"></h3>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="card shadow-sm" style="border-left: 3px solid #333;">
				<div class="card-body" style="min-height: 110px;">
					<p>Total de Depoimentos</p>
					<h3 id="testimonials" class="mb-0 text-center loader"></h3>
				</div>
			</div>
		</div>
	</div>

	<div class="row mb-4">
		<div class="col-sm-6">
			<div class="card shadow-sm">
				<div class="card-body">
					<canvas id="visitsReport"></canvas>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="card shadow-sm">
				<div class="card-body">
					<canvas id="usersReport"></canvas>
				</div>
			</div>
		</div>
	</div>

	<div class="row mb-4">
		<div class="col-sm-6">
			<div class="card shadow-sm">
				<div class="card-body">
					<canvas id="petsReport"></canvas>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="card shadow-sm">
				<div class="card-body">
					<canvas id="testimonialsReport"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
