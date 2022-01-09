<!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="{{route('site.home')}}" class="navbar-brand">
        <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <span class="brand-text font-weight-light">Show Tv</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="{{route('site.home')}}" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="{{route('site.profile')}}" class="nav-link">Profile</a>
          </li>
          <li class="nav-item dropdown">
              @php
                  $shows = \App\Models\Show::where('type', 2)->get();
              @endphp
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                5 tv-shows
            </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                @foreach ($shows as $show)

                <li>
                    <a href="{{route('site.show', $show->id)}}" class="dropdown-item">
                        {{ Str::limit($show->title??'', 10, '...') }}
                    </a>
                </li>
                @endforeach
            </ul>
          </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-0 ml-md-3" action="{{ route('site.search') }}" method="GET">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" name="search" value="{{ request('search') }}" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </nav>
  <!-- /.navbar -->
