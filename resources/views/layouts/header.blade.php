<header>
    <nav class="navbar navbar-light bg-white shadow-sm">
      <a class="navbar-brand ml-auto mr-auto ml-lg-5 pl-lg-5" href="{{ url('/') }}">
          <b>{{ __('Surf Store') }}</b>
      </a>
      <div id="header-options" class="mr-5 pr-5 d-none d-lg-block">
        @guest
          <a href="{{ route('login') }}"><i class="fa fa-user"></i>Sign in</a>
          <a href="{{ route('register') }}"><i class="fa fa-sign-in"></i>Registration</a>
        @else
          <a href="{{ route('home') }}"><i class="fa fa-user"></i>Profile</a>
          @if(Auth::user()->hasRole('admin'))
            <a href="/admin"><i class="fa fa-server"></i>Admin panel</a>
            <a href="/products/add"><i class="fa fa-plus"></i>Add product</a>
          @endif
          <a class="btn btn-default p-0" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('_logout-form_').submit();">
              <i class="fa fa-sign-out"></i>Sign out
          </a>
          <form id="_logout-form_" action="{{ route('logout') }}" method="POST" hidden>@csrf</form>
        @endguest
        <a href="{{ route('cart') }}"><i class="fa fa-shopping-cart"></i>Cart</a>
      </div>
    </nav>
    <div id="header-root"></div>
</header>
