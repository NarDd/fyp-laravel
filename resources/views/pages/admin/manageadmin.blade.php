@extends('layouts.master')

@section('css')

@endsection


@section('title','User List')
@section("container")
<form class="col s12" id="event.create" method="POST" enctype="multipart/form-data"><div class="row">
  <div class="card" id="userlist-card" id="top-card">
      <div class="row">
        <div class="col s12">
          <h5>Admin Management</h5>
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
              <th>Set Admin Privileges</th>
            </tr>
          </thead>
          <tbody>
            @for($i = 0 ; $i < count($user); $i++)
                <tr>
                <td>{{$user[$i]->name}}</td>
                <td>{{$user[$i]->email}}</td>
                <td>
                  @if($user[$i]->isadmin == true)
                    Yes
                  @else
                    No
                  @endif
                </td>

                <td class="left">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  @if($user[$i]->isadmin == true)
                  <button value="{{$user[$i]->id}}" name="id" type="submit" class="btn btn-primary red">Revoke</button>
                  @else
                  <button style="width:100%" value="{{$user[$i]->id}}" name="id" type="submit" class="btn btn-primary">Set</button>
                  @endif
                </td>

            @endfor
          </tbody>
          </table>
        </div>
      </div>

  </div>
</div>
</form>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
  $('select').material_select();
});

</script>
@endsection
