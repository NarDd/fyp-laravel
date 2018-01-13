@extends('layouts.master')

@section('css')

@endsection


@section('title','Profile')
@section("container")
<div class="row">
  <div class="col s12">
    <div class="card-panel">
    <div class="row">
    <div class="col s12">
    <a href="{{route('profile.update.get')}}" class="btn btn-primary right">Update Profile</a>
    </div>
    <h4>Profile</h4>
    <h6>Name: {{$user->name}}</h6>
    <h6>Email:{{$user->email}}</h6>
    </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col s12">
    <div class="card-panel">
    <div class="row">
    <div class="col s12">
    <a href="{{route('profile.update.skill.get')}}" class="btn btn-primary right">Update Skillset</a>
    </div>
    <h4>Special Skills</h4>
    @foreach($skill as $s)
    <h6>{{$s->skill_name}}</h6>
    @endforeach
    </div>
    </div>
  </div>
</div
@endsection

@section('scripts')

@endsection
