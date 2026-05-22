<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['dashboard']) ? '' : 'collapsed' }}" href="{{ route('dashboard') }}">
    <i class="bi bi-grid"></i>
    <span>Dashboard</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['users_index','users_show']) ? '' : 'collapsed' }}" href="{{ route('users_index') }}">
    <i class="bi bi-person-badge"></i>
    <span>Hodimlar</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['omborxona_kassa_index','omborxona_currer_index', 'omborxona_omborchi_index']) ? '' : 'collapsed' }}" data-bs-target="#omborxona-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-pie-chart"></i><span>Omborxona</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="omborxona-nav" class="nav-content collapse {{ request()->routeIs(['omborxona_kassa_index','omborxona_currer_index','omborxona_omborchi_index']) ? 'show' : '' }}" data-bs-parent="#omborxona-nav">
    <li>
      <a href="{{ route('omborxona_kassa_index') }}" class="nav-link {{ request()->routeIs(['omborxona_kassa_index']) ? '' : 'collapsed' }}">
        <i class="bi bi-circle"></i><span>Kassa</span>
      </a>
    </li>
    <li>
      <a href="{{ route('omborxona_currer_index') }}" class="nav-link {{ request()->routeIs(['omborxona_currer_index']) ? '' : 'collapsed' }}">
        <i class="bi bi-circle"></i><span>Xaydovchilar</span>
      </a>
    </li>
    <li>
      <a href="{{ route('omborxona_omborchi_index') }}" class="nav-link {{ request()->routeIs(['omborxona_omborchi_index']) ? '' : 'collapsed' }}">
        <i class="bi bi-circle"></i><span>Omborchilar</span>
      </a>
    </li>
  </ul>
</li>

<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['moliya_index']) ? '' : 'collapsed' }}" href="{{ route('moliya_index') }}">
    <i class="bi bi-person-badge"></i>
    <span>Moliya</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link {{ request()->routeIs(['regions_index','regions_show', 'moliya_settings']) ? '' : 'collapsed' }}" 
    data-bs-target="#region-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-pie-chart"></i><span>Sozlamalar</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="region-nav" class="nav-content collapse {{ request()->routeIs(['regions_index','regions_show', 'moliya_settings']) ? 'show' : '' }}" data-bs-parent="#region-nav">
    <li>  
      <a href="{{ route('regions_index') }}" class="nav-link {{ request()->routeIs(['regions_index','regions_show']) ? '' : 'collapsed' }}">
        <i class="bi bi-circle"></i><span>Hududlar</span>
      </a>
    </li>
    <li>
      <a href="{{ route('moliya_settings') }}" class="nav-link {{ request()->routeIs(['moliya_settings']) ? '' : 'collapsed' }}">
        <i class="bi bi-circle"></i><span>Narxlar</span>
      </a>
    </li> 
    <li>
      <a href="#" class="nav-link collapsed">
        <i class="bi bi-circle"></i><span>Menu03</span>
      </a>
    </li>
  </ul>
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