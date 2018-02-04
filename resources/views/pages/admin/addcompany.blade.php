@extends('layouts.master')

@section('css')
<link href="{{URL::asset('css/main.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
@endsection


@section('title','Companies Management')
@section("container")
<div class="row">
  <div class="col s12">
      <div class="card">
        <div class="row">
        <form class="col s12" id="company.create" method="POST" enctype="multipart/form-data">
          <h5>Add A New Company</h5>
          <div class="input-field col s12">
            <input id="company" placeholder="e.g Siemens" name="company" type="text" class="validate">
            <label for="company">New Company</label>
          </div>

          <div class="input-field col s6">
            <input id="search" placeholder="e.g alex@company.com" name="coordinatoremail" type="text" class="validate form-control searchbar">
            <label for="search">Search Coordinator Email</label>
          </div>

            <div class="col s12">
            <table class="table table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Select User</th>
              </tr>
            </thead>
            <tbody>
              @for($i = 0 ; $i < count($users); $i++)
                  <tr class="searchable">
                  <td>{{$users[$i]->name}}</td>
                  <td>{{$users[$i]->email}}</td>
                  <td>
                    <input type="radio" name="user" value="{{$users[$i]->id}}" id="{{$users[$i]->id}}"><label for="{{$users[$i]->id}}"></label>
                  </td>
              @endfor
            </tbody>
          </table>

          </div>
          <div class="row">
            <div class="col s12">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input id="right-btn" type="submit" value="Add New Company" class="btn btn-primary">
            </div>
          </div>
        </form>
      </div>
      </div>
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('js/search.js') }}"></script>
@endsection
