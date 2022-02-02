<nav class="navbar navbar-expand-lg navbar-light bg-white static-top">
  <div class="container">
    <a class="navbar-brand" href="#"><img src="{{url('storage/img/sysmex.png')}}" width="230"></a>
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="navbarsExample03" style="">
      @if(Session::get('islogin'))

        <!--
        Koagulasi navigation bar
        -->
        @if(Request::is('equas/koagulasi/*'))
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{route('koagulasi.home')}}"><strong>HOME</strong></a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="{{route('koagulasi.profile')}}"><strong>PROFILE</strong></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('koagulasi.instrument')}}"><strong>MYEQUAS</strong></a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="{{ route('koagulasi.logout') }}"><strong>LOGOUT</strong></a>
          </li>
        </ul>
        @endif

        <!--
        Urin navigation bar
        -->
        @if(Request::is('equas/urin/*'))
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{route('urin.home')}}"><strong>HOME</strong></a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="{{route('urin.profile')}}"><strong>PROFILE</strong></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('urin.instrument')}}"><strong>MYEQUAS</strong></a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="{{ route('urin.logout') }}"><strong>LOGOUT</strong></a>
          </li>
        </ul>
        @endif
        
        @if(Request::is('equas/admin/*'))
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.home') }}"><strong>HOME</strong></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="{{ route('admin.manage') }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <strong>MANAGE</strong>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">User</a>
              <a class="dropdown-item" href="#">Instrument</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('admin.periode',['step'=>0]) }}">Periode</a>
            </div>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.logout') }}"><strong>LOGOUT</strong></a>
          </li>
        </ul>
        @endif
      
      @else
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
        <a class="nav-link" href=""><strong>LOGIN</strong></a>
        </li>
      </ul>
      @endif
    </div>
  </div>
</nav>