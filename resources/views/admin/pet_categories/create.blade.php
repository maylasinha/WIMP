@extends('layouts.dashboard')

@section('content')

@include('admin.pet_categories._page_header')

<div class="container-fluid">
	<div class="card-group">
		<div class="card border-right">
			<div class="card-body">
				<form action="{{ route('admin.pet_categories.store') }}" method="post" enctype="multipart/form-data">
					<div class="form-body">
						@csrf
						@include('admin.pet_categories._form')
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection