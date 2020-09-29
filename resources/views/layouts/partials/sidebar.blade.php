<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="/users">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Users</span></a>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="/roles">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Roles</span></a>
      </li>


      <!-- Nav Item -->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('departments.index') }}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Departments</span></a>
      </li>

      <!-- Nav Item -->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('employees.index') }}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Employees</span></a>
      </li>


      <!-- Nav Item -->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('equipments.index') }}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Equipments</span></a>
      </li>

    </ul>