<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['dashboard']) ? '' : 'collapsed' }}" href="{{ route('dashboard') }}">
    <i class="bi bi-grid"></i>
    <span>Dashboard</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link collapsed" href="">
    <i class="bi bi-person-badge"></i>
    <span>Menu1</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#chart-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-pie-chart"></i><span>Menu2</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="chart-nav" class="nav-content collapse data-bs-parent="#sidebar-nav">
    <li>
      <a href="#" class="nav-link collapsed">
        <i class="bi bi-circle"></i><span>Menu01</span>
      </a>
    </li>
    <li>
      <a href="#" class="nav-link collapsed">
        <i class="bi bi-circle"></i><span>Menu02</span>
      </a>
    </li>
    <li>
      <a href="#" class="nav-link collapsed">
        <i class="bi bi-circle"></i><span>Menu03</span>
      </a>
    </li>
  </ul>
</li>