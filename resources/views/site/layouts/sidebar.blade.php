<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link text-center">
    <span class="brand-text font-weight-light">{{env('APP_NAME')}}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
          <a href="{{route('adminPanel.dashboard')}}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>
        
        @can('roles view')
          <li class="nav-item">
            <a href="{{route('adminPanel.roles.index')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p> Roles </p>
            </a>
          </li>
        @endcan

        @can('admins view')
          <li class="nav-item">
            <a href="{{route('adminPanel.admins.index')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Admins</p>
            </a>
          </li>
        @endcan

        @can('users view')
          <li class="nav-item">
            <a href="{{route('adminPanel.users.index')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Users</p>
            </a>
          </li>
        @endcan

        @can('shows view')
          <li class="nav-item">
            <a href="{{route('adminPanel.shows.index')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Shows</p>
            </a>
          </li>
        @endcan

        <li class="nav-item">
          <a href="{{route('adminPanel.logout')}}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>Logout</p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
 