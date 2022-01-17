<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{route('home')}}" class="brand-link">
    <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-light">HeyKodi</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        @auth
        <a href="#"> {{auth()->user()->name}}</a>
        @endauth
      </div>
    </div> --}}
    {{--
    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div> --}}

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <li class="nav-item">
          <a href="{{route('home')}}" class="nav-link {{request()->is('/') || request()->is('home')  ?' active ':''}}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Home
            </p>
          </a>
        </li>

        {{-- with badge --}}
        {{-- <li class="nav-item">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Simple Link
              <span class="right badge badge-danger">New</span>
            </p>
          </a>
        </li> --}}
{{-- 
    {{-- dropdownlink
        <li class="nav-item ">
          <a href="#" class="nav-link ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Starter Pages
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Active Page</p>
              </a>
            </li>
          </ul>
        </li> --}}


        <li class="nav-item {{request()->is(config('simple.prefix_url').'/*') ? 'menu-open' : ''}}" style="margin-top: 100px">
          <a href="#" class="nav-link ">
            <i class="nav-icon {{config('simple.menu.icon')}}"></i>
            <p>
              {{config("simple.menu.label")}}
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @forelse (config("simple.models") as $key => $value)
            <li class="nav-item">
              <a href="{{url(config('simple.prefix_url').'/'.$key)}}" class="nav-link {{request()->is(config('simple.prefix_url').'/'.$key) ? 'active' : ''}}">
                <i
                  class="nav-icon {{isset($value['icon']) && $value['icon'] != '' ? $value['icon'] : 'far fa-circle'}}"></i>
                <p>{{$value['label'] ?? $key}}</p>
              </a>
            </li>
            @empty

            @endforelse

          </ul>
        </li>

        {{-- open tree --}}
        {{-- <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Starter Pages
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link active">
                <i class="far fa-circle nav-icon"></i>
                <p>Active Page</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Inactive Page</p>
              </a>
            </li> --}}


          </ul>
        </li>



      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>