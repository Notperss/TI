<!-- BEGIN: Header-->
<nav
  class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light bg-info navbar-shadow">
  <div class="navbar-wrapper">

    <div class="navbar-header">
      <ul class="flex-row nav navbar-nav">
        <li class="mr-auto nav-item mobile-menu d-md-none"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
            href="#"><i class="ft-menu font-large-1"></i></a></li>
        <li class="nav-item"><a class="navbar-brand" href="{{ route('backsite.dashboard.index') }}"><img
              class="brand-logo" alt="modern admin logo" src="{{ asset('/assets/app-assets/images/ico/cmnp.png') }}">
            <h4 class="brand-text">Teknologi Informasi</h4>
          </a></li>
        <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse"
            data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
      </ul>
    </div>

    <div class="navbar-container content">
      <div class="collapse navbar-collapse" id="navbar-mobile">

        <ul class="float-left mr-auto nav navbar-nav">
          <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
              href="#"><i class="
                            la la-arrows-h"></i></a></li>
          <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand" href="#"><i
                class="ficon ft-maximize"></i></a></li>
        </ul>

        <ul class="float-right nav navbar-nav">
          <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link"
              href="#" data-toggle="dropdown"><span
                class="mr-1 user-name text-bold-700">{{ Auth::user()->name }}</span> <i
                class="la la-bars font-large-1 float-right"></i><span class="avatar avatar-online">
                @if (Auth::user()->icon)
                  <img src="{{ asset('storage/' . Auth::user()->icon) }}" alt="avatar">
                @else
                  <img src="{{ asset('/assets/app-assets/images/portrait/small/pic.jpeg') }}" alt="avatar">
                @endif
                {{-- <img src="{{ asset('storage/' . Auth::user()->icon) }}" alt="avatar"> --}}
                {{-- @if (File::exists(public_path('assets/file-user/' . $detail_user->icon)))
                                    <img src="{{ asset('storage/' . $detail_user->icon) }}" alt="avatar">
                                @else
                                    <img src="{{ asset('/assets/app-assets/images/portrait/small/avatar-s-19.png') }}"
                                        alt="avatar">
                                @endif --}}
                <i></i>
              </span></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="{{ route('backsite.profile.index') }}">
                <i class="la la-user"></i> Profile
              </a>
              <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="ft-power"></i> Logout
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
<!-- END: Header-->
