@extends('layouts.dashboard')

@section('content')

@include('admin.users._page_header')

<div class="container-fluid">
	@include('shared.flash_messages')
	
	<div class="card-group">
		<div class="card border-right">
			<div class="card-body">
				<form action="{{ route('admin.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
					<div class="form-body">
						@method('PATCH')
						@csrf
						@include('admin.users._form')
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection