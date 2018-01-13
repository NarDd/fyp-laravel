@extends('layouts.master')

@section('css')

@endsection


@section('title','User List')
@section("container")
<form class="col s12" id="event.create" method="POST" enctype="multipart/form-data"><div class="row">
  <div class="card" id="userlist-card" id="top-card">
      <div class="row">
        <div class="col s12">
          <h5>Users</h5>
        </div>
      </div>

      <div class="row">
        <div class="col s12">
          <table class="table table-hover">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Admin</th>
              <th class="right">Set Admin Privileges<th>
            </tr>
          </thead>
          <tbody>
          @foreach($user as $u)
            <tr>
              <td>{{$u->name}}</td>
              <td>{{$u->email}}</td>
              <td>
                @if($u->isadmin == true)
                  Yes
                @else
                  No
                @endif
              </td>
            <td>
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button id="right-btn" value="{{$u->id}}" name="id" type="submit" class="btn btn-primary right">Set</button>
            </td>
          @endforeach
          </tbody>
          </table>
        </div>
      </div>

  </div>
</div>
</form>
@endsection

@section('scripts')

@endsection
