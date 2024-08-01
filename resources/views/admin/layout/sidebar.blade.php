<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item menu-open">
      <ul class="nav nav-treeview">
        <li class="nav-item">
        <li class="nav-item">
          <a href="{{url('/admin/dashboard')}}" class="nav-link">
            <i class="fa fa-home nav-icon"></i>
            <p>Home</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{url('/admin/profile')}}" class="nav-link">
            <i class="fa fa-id-badge nav-icon"></i>
            <p>Profile</p>
          </a>
        </li>
    </li>
    <li class="nav-item">
      <a href="{{url('/admin/user')}}" class="nav-link">
        <i class="fa fa-user-circle nav-icon"></i>
        <p>Users</p>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#submenu0sub0" data-toggle="collapse" data-target="#submenu0sub0"><i class="fa fa-duotone fa-users nav-icon"></i>
        <p>Data Management</p><i class="fa fa-solid fa-chevron-right"></i>
      </a>
      <div class="collapse {{ Request::url() == route('data.view') ? 'show in' : ''}}" id="submenu0sub0" aria-expanded="false">
        <ul class="flex-column nav pl-4">
          <li class="nav-item">
            <a class="nav-link p-1 text-truncate" href="{{route('data.view')}}">
              <i class="fa fa-regular fa-circle nav-icon"></i>Subscription</a>
          </li>
         
        </ul>
      </div>
</li>
    <li class="nav-item">
      <a class="nav-link" href="#submenu1sub1" data-toggle="collapse" data-target="#submenu1sub1"><i class="fa fa-duotone fa-users nav-icon"></i>
        <p>User Management</p><i class="fa fa-solid fa-chevron-right"></i>
      </a>
      <div class="collapse {{ Request::url() == route('permission.view') ? 'show in' : ''}} {{ Request::url() == route('roles.view') ? 'show in' : ''}} {{ Request::url() == route('roles.Permission.view') ? 'show in' : ''}} {{ Request::url() == route('assign.roles.view') ? 'show in' : ''}}" id="submenu1sub1" aria-expanded="false">
        <ul class="flex-column nav pl-4">
          <li class="nav-item">
            <a class="nav-link p-1 text-truncate" href="{{route('permission.view')}}">
              <i class="fa fa-regular fa-circle nav-icon"></i>Permission</a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-1 text-truncate" href="{{route('roles.view')}}">
              <i class="fa fa-regular fa-circle nav-icon"></i>Role</a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-1 text-truncate" href="{{route('roles.Permission.view')}}">
              <i class="fa fa-regular fa-circle nav-icon"></i>Role Permission</a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-1 text-truncate" href="{{route('assign.roles.view')}}">
              <i class="fa fa-regular fa-circle nav-icon"></i>Assign Role</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a href="{{url('/admin/logout')}}" class="nav-link">
        <i class="fa fa-sign-out nav-icon"></i>
        <p>
          Logout
        </p>
      </a>
    </li>
  </ul>
</nav>
<script>
  $(document).ready(function() {
    var fullpath = window.location.pathname;
    var filename = fullpath.replace(/^.*[\\\/]/, '');
    var last = "{{url('/')}}/admin/" + filename;
    var currentLink = $('a[href="' + last + '"]');
    currentLink.addClass("active");
  });
</script>