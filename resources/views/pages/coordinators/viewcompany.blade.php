@extends('layouts.master')

@section('css')
<link href="{{URL::asset('css/main.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
@endsection


@section('title', "$company->name")
@section("container")
<div class="row">
  <div class="col s12">
      <div class="card">
        <div class="row">
        <form class="col s12" method="POST" enctype="multipart/form-data">
          <h5>{{$company->name}}</h5>
            <div class="col s12">
              <table class="table table-hover">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Current Status</th>
                  <th>Change Status</th>
                </tr>
              </thead>
              <tbody>
                @for($i = 0 ; $i < count($user); $i++)
                    <tr>
                    <td>{{$user[$i]->name}}</td>
                    <td>{{$user[$i]->email}}</td>
                    <td>
                        {{$user[$i]->status}}
                    </td>

                    <td>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      @if($user[$i]->status == "Pending")
                      <button value="{{$user[$i]->id}}" name="approve" type="submit" class="btn btn-primary">Set Approve</button>
                      <button value="{{$user[$i]->id}}" name="reject" type="submit" class="btn btn-primary red">Set Reject</button>
                      @elseif($user[$i]->status == "Rejected")
                      <button value="{{$user[$i]->id}}" name="approve" type="submit" class="btn btn-primary">Set Approve</button>
                      @elseif($user[$i]->status == "Approved")
                      <button value="{{$user[$i]->id}}" name="reject" type="submit" class="btn btn-primary red">Set Reject</button>
                      @endif
                    </td>

                @endfor
              </tbody>
              </table>



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
