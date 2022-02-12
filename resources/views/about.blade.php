@extends('layouts.site')

@section('content')
	<div class="py-5 page about">
		<div class="container">
			<h3 class="section-title mb-4">{{ @$title }}</h3>

      <div class="card">
      	<div class="card-body">
					{!! $page->body !!}
				</div>
      </div>
		</div>
	</div>
@endsection