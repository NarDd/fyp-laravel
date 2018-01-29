<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

  <title>@yield("title")</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="{{URL::asset('css/materialize.min.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{URL::asset('css/style.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  @yield('css')
  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="{{URL::asset('js/materialize.min.js')}}"></script>
  <script src="{{URL::asset('js/init.js')}}"></script>


</head>


<body>
<header>
<div class="navbar">
<nav>
  <div class="row">
  <div class="col l12">
  <div class="nav-wrapper">
    <a id="logo" href="{{ route('home') }}" class="logo"><img src="{{ asset('img/MatchIt_Logo.png') }}" class="logo" alt="logo"/></a>
    <ul class="left hide-on-med-and-down">
      <li><a href="{{ route('home') }}"><i class="material-icons left">home</i>Home</a></li>
      <li><a href="{{ route('upcoming.events') }}"><i class="material-icons left">event</i>Upcoming Events</a></li>
      <li><a href="{{ route('past.events') }}"><i class="material-icons left">history</i>Past Events</a></li>
      <li><a class="dropdown-button" href="#!" data-activates="dropdown1" style="width:200px"><i class="material-icons left">settings</i>Admin</a></li>
    </ul>

    <ul class="right hide-on-med-and-down">
      @if(!auth()->check())
      <!-- <li><a href="{{ route('register') }}"><i class="material-icons left">assignment_ind</i>Register</a></li> -->
      <li><a class="modal-trigger" href="#loginModal"><i class="material-icons left">assignment_ind</i>Login/Register</a></li>
      @else

      <li><a href="{{ route('profile.view') }}"><i class="material-icons left">face</i>Profile</a></li>
      <li><a href="{{ route('logout.post') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><i class="material-icons left">exit_to_app</i>Logout</a>
      <form id="frm-logout" action="{{ route('logout.post') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
      </form>
      </li>
      @endif
    </ul>
      </div>
    <ul id="nav-mobile" class="side-nav">
      <li><a href="#">Navbar Link</a></li>
    </ul>
    <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
  </div>
</div>
</div>
</nav>
</div>




<ul id="dropdown1" class="dropdown-content">
<li><a class="dropdown-item" href="{{ route('admin.event.create') }}">Create Event</a></li>
<li><a class="dropdown-item" href="{{ route('admin.event.viewall') }}">Update Events</a></li>
<li class="divider"></li>
<li><a class="dropdown-item" href="{{ route('admin.manage.userlist') }}">Manage User</a></li>
<li><a class="dropdown-item" href="{{ route('admin.create.skill.get') }}">Add Skills</a></li>
</ul>
</header>
<!--/.Navbar-->


<div id="loginModal" class="modal">
  <form method="POST" action="{{route('login.post')}}">
    <div class="modal-content">
      <div class="row">
        <div class="col s12">
            <h4>Login</h4>
        </div>
      </div>

      <div class="row">
        <div class="col s12">
              Email : <input type="text" name="email" class="form-control" placeholder="Email">
              Password :  <input type="password" name="password" class="form-control" placeholder="Email">
              @if (Session::has('Invalid Credentials'))
              <div class="alert alert-danger">{{Session::get('Invalid Credentials')}}</div>
              @endif
        </div>
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="submit" value="Login" class="btn btn-primary right">
      </div>



      <div class="row">
        <div class="col s12">
        <a href="{{url('/redirect')}}" class="waves-effect waves-light btn blue col s12 social facebook">
        <i class="fa fa-facebook"></i> Continue with facebook</a>
        </div>
      </div>

      <div class="row">
        <div class="col s12 center">
          <span>Not a member yet? Register with email</span>
        </div>
      </div>

      <div class="row">
        <div class="col s12">
          <a href="{{ route('register') }}" class="waves-effect waves-light btn red col s12 social facebook">
          <i class="fa fa-envelope"></i> Register with email</a>
        </div>
      </div>

    </div>


  </form>
</div>

@yield('content')

<div class="container main-container">
@yield('container')
</div>

<script type="text/javascript">
$(document).ready(function(){
  $('.modal').modal();
});
</script>

<!-- Login Modal Script -->
@if (Session::has('Invalid Credentials'))
<script type="text/javascript">
$(document).ready(function(){
  $('#loginModal').modal('open');
});
</script>
@endif

@yield("scripts")

</body>

</html>
