@extends('layouts.master')

@section('css')

@endsection


@section('title','Register')
@section("container")
<div class="row">
<div class="col s12">
    <div class="card">
      <div class="row">
        <div class="col s12">
        <h5>Register</h5>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
            {{ $error }}<br>
          @endforeach
        </div>
        @endif
        </div>
      </div>
      <div class="row">
          <form class="col s12" id="register" method="POST">
            <div class="row">
              <div class="col s11">
              <div class="input-field col s12">
                <input id="name" placeholder="e.g James Bond" name="name" type="text" class="validate">
                <label for="event_name">Full Name</label>
              </div>
              </div>
            </div>
            <div class="row">
              <div class="col s11">
              <div class="input-field col s12">
                <input id="email" placeholder="e.g example@gmail.com" name="email" type="text" class="validate">
                <label for="event_name">Email</label>
              </div>
              </div>
            </div>
            <div class="row">
              <div class="col s11">
              <div class="input-field col s12">
                <input id="password" name="password" placeholder="Enter password" type="password" class="validate">
                <label for="event_name">Password</label>
              </div>
              </div>
            </div>
            <div class="row">
              <div class="col s11">
              <div class="input-field col s12">
                <input id="password_confirmation" name="password_confirmation" placeholder="Re-enter password" type="password" class="validate">
                <label for="password_confirmation">Confirm Password</label>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col s12">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" value="Register" class="btn btn-primary right">
            </div>
            </div>


          </form>
      </div>

    </div>
</div>
</div>


@endsection

@section('scripts')

@endsection
