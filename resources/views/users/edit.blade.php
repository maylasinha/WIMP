@extends('layouts.site')

@section('content')
  <div class="py-5 page account">
    <div class="container">
      <div class="row">
        <div class="col-sm-3">
          @include('shared.sidebar_user')
        </div>
        <div class="col-sm-9">
          @include('shared.flash_messages')

          <form method="POST" action="{{ route('users.update') }}" class="card">
            @csrf
            
            <div class="card-body">
              @include('users._form')
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
