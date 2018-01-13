@extends('layouts.master')

@section('css')

@endsection


@section('title','Update Event')
@section("content")
<br>
<div class="container">
  <h3 class="head-title">Update Event</h3>
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-12">
        <h4>Event Name:</h4>
        <form id="create-form" method="post">
        <div class="form-group">
          <input type="text" name="event_name" class="form-control" placeholder="Event Name">
        </div>
      </div>
      <div class="col-md-12">
        <h4>Event Date:</h4>
        <div class="form-group">
          <input type="text" name="event_start" class="form-control" placeholder="Event Start Time">
        </div>
      </div>
      <div class="col-md-6">
        <h4>Event Start Time:</h4>
        <div class="form-group">
          <input type="text" name="event_start" class="form-control" placeholder="Event Start Time">
        </div>
      </div>
      <div class="col-md-6">
        <h4>Event End Time:</h4>
        <div class="form-group">
          <div class="form-group">
            <input type="text" name="event_start" class="form-control" placeholder="Event Start Time">
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <h4>Description of Event:</h4>
        <div class="form-group">
          <textarea type="text" name="desc" class="form-control" cols="30" rows="7" placeholder="Description of Event"></textarea>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
            {{ csrf_field() }}
          <input type="submit" value="Create Event" class="btn btn-primary">
        </div>
      </div>
    </form>
    </div>
</div>
</div>
@endsection

@section('scripts')

@endsection
