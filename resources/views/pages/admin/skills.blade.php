@extends('layouts.master')

@section('css')
<link rel="stylesheet" type="text/css" href=" {{ asset('css/slick/slick.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/slick/slick-theme.css') }}">
@endsection


@section('title','Edit Skills')
@section("container")
<form class="col s12" id="event.create" method="POST" enctype="multipart/form-data">
  <div class="row">
          <div class="col s12">
            <!-- Errors upon submit -->
            @if (count($errors) > 0)
            <div class="alert alert-danger">
              @foreach ($errors->all() as $error)
                {{ $error }}<br>
              @endforeach
            </div>
            @endif
            <!-- Errors upon submit -->

              <h5>Edit Special Skills</h5>
              <div class="row">
              <div class="col s12">

              </div>
              </div>

          </div>
    </div>
</form>
@endsection

@section('scripts')

@endsection
