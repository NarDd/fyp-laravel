@extends('layouts.master')

@section('css')

@endsection


@section('title','User Approval')
@section("container")

<div class="row">
  <div class="card" id="userlist-card" id="top-card">
      <div class="row">
        <div class="col s12">
          <h5>Approval</h5>
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
        <div class="col s12">
          <h6>Name: {{$user->name}}</h6>
          <h6>Email: {{$user->email}}</h6>
        </div>
      </div>

      <hr>
      <form id="approve" method="POST">
      <div class="row">
        <div class="col s12">
            <input type="submit" value="Approve" name="submitbtn" class="btn right">
        </div>
      </div>

      <div class="row">
        <div class="col s12">
            <h5>Rejection Reason</h5>
        </div>
      </div>

      <div class="row">
        <div class="col s12">
          <div class="input-field col s12">
            <textarea id="reason" name="reason" placeholder="e.g This person is rejected because of past history" class="materialize-textarea"></textarea>
            <label for="reason">Reason</label>
          </div>
        </div>
      </div>

        <div class="row">
          <div class="input-field col s12">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" value="Reject" name="submitbtn" class="btn red right">
          </div>
        </div>
      </form>




  </div>
</div>

@endsection

@section('scripts')

@endsection
