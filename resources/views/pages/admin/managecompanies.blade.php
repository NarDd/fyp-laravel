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
          <div class="col s12">

          <button type="button" class="btn btn-primary right" onclick="window.location='{{ route("admin.manage.add.companies") }}'">Add New Company</button>

          <h5>List of Companies</h5>
          <table class="table table-hover">
          <thead>
            <tr>
              <th>Company Name</th>
              <th>Coordinator</th>
              <th>Coordinator's Email</th>
              <th>View Company</th>
            </tr>
          </thead>
          <tbody>
            @for($i = 0 ; $i < count($companies); $i++)
                <tr>
                <td>{{$companies[$i]->name}}</td>
                <td>{{$coordinators[$i]->name}}</td>
                <td>{{$coordinators[$i]->email}}</td>
                <td><button type="button" class="btn btn-primary" onclick="window.location='{{ route("coordinator.view.company",$coordinators[$i]->company_id) }}'">View Company</button></td>
            @endfor
          </tbody>
          </table>
          </div>

      </div>
      </div>

  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('js/search.js') }}"></script>
@endsection
