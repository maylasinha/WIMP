@extends('layouts.dashboard')

@section('content')

@include('admin.pet_categories._page_header')

<div class="container-fluid">
	<div class="card">
		<div class="card-body">
			<form action="{{ route('admin.pet_categories.update', $pet_category->id) }}" method="post" enctype="multipart/form-data">
				<div class="form-body">
					@method('PATCH')
					@csrf
					@include('admin.pet_categories._form')
				</div>
			</form>
		</div>
	</div>
</div>
@endsection