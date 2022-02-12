@extends('layouts.site')

@section('content')
  <div class="py-5 page address">
    <div class="container">
      <div class="row">
        <div class="col-sm-3">
          @include('shared.sidebar_user')
        </div>
        <div class="col-sm-9">
        	<form action="{{ route('pets.pet_images.store', $pet->id) }}" method="post" enctype="multipart/form-data" class="card">
						<div class="card-body">
							@csrf
							@include('pet_images._form')
						</div>
					</form>
        </div>
      </div>
    </div>
  </div>
@endsection
