@extends('layouts.site')

@section('content')
  <div class="py-5 page pet">
    <div class="container">
      <div class="row">
        <div class="col-sm-3">
          @include('shared.sidebar_user')
        </div>
        <div class="col-sm-9">
        	<form action="{{ route('pets.pet_images.update', [$pet_image->pet_id, $pet_image->id]) }}" method="post" enctype="multipart/form-data" class="card">
						<div class="card-body">
              @method('PATCH')
							@csrf
							@include('pet_images._form')
						</div>
					</form>
        </div>
      </div>
    </div>
  </div>
@endsection
