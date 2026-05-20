<nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center list-unstyled mb-0 gap-3">
        
        <!-- Tug'ilgan kunlar xabarnomasi (Zamonaviy Badge bilan) -->
        <li class="nav-item">
            <a class="nav-link nav-icon-wrapper position-relative d-flex align-items-center justify-content-center" href="#">
                <i class="bi bi-cake2 fs-5"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger modern-badge">
                    4
                </span>
            </a>
        </li>

        <!-- Foydalanuvchi Profili (Dropdown) -->
        <li class="nav-item dropdown pe-2">
            <a class="nav-link nav-profile d-flex align-items-center gap-2" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="avatar-wrapper">
                    <i class="bi bi-person-circle fs-4 text-secondary"></i>
                </div>
                <span class="d-none d-md-inline dropdown-toggle fw-semibold text-dark fs-14">
                    {{ Str::upper(Auth::user()->type ?? 'User') }}
                </span>
            </a>

            <!-- Zamonaviy Dropdown menyu -->
            <ul class="dropdown-menu dropdown-menu-end profile-dropdown shadow-lg mt-3 border-0">
                <li class="dropdown-header text-center p-4">
                    <div class="dropdown-avatar-circle mx-auto mb-2">
                        <i class="bi bi-person-badge fs-2 text-primary"></i>
                    </div>
                    <h6 class="mb-1 text-dark fw-bold">{{ Auth::user()->name }}</h6>
                    <small class="text-muted d-block mb-2">{{ Auth::user()->phone }}</small>
                    <span class="badge role-badge px-3 py-1.5">{{ Auth::user()->type }}</span>
                </li>
                
                <li><hr class="dropdown-divider opacity-50 m-0"></li>
                
                <li>
                    <a class="dropdown-item d-flex align-items-center py-2.5 px-3 transition-all" href="#">
                        <i class="bi bi-person-vcard me-2.5 text-primary fs-5"></i>
                        <span class="fs-14 fw-medium">Profil sozlamalari</span>
                    </a>
                </li>
                
                <li><hr class="dropdown-divider opacity-50 m-0"></li>
                
                <li>
                    <a class="dropdown-item d-flex align-items-center py-2.5 px-3 text-danger transition-all" href="#" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right me-2.5 fs-5"></i>
                        <span class="fs-14 fw-medium">Tizimdan chiqish</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li> 
    </ul>
</nav>
<style>
    .fs-14 {font-size: 14px !important;}
    .nav-icon-wrapper {color: #5f6368;width: 40px;height: 40px;border-radius: 50%;transition: all 0.25s ease;background: rgba(0, 0, 0, 0.02);}
    .nav-icon-wrapper:hover {color: #0d6efd;background: rgba(13, 110, 253, 0.08);transform: translateY(-1px);}
    .modern-badge {font-size: 10px;padding: 4px 6px;border: 2px solid #fff;box-shadow: 0 2px 5px rgba(220, 53, 69, 0.3);}
    .profile-dropdown {min-width: 260px;border-radius: 16px !important;background: rgba(255, 255, 255, 0.95) !important;backdrop-filter: blur(15px);-webkit-backdrop-filter: blur(15px);transform: translateY(10px);transition: all 0.3s ease;}
    .dropdown-avatar-circle {width: 54px;height: 54px;background: rgba(13, 110, 253, 0.06);border-radius: 50%;display: flex;align-items: center;justify-content: center;}
    .role-badge {background: rgba(13, 110, 253, 0.08) !important;color: #0d6efd !important;font-weight: 600;font-size: 11px;border-radius: 30px;}
    .profile-dropdown .dropdown-item {border-radius: 8px;margin: 4px 8px;width: calc(100% - 16px);color: #495057;transition: all 0.2s ease;}
    .profile-dropdown .dropdown-item:hover {background: rgba(0, 0, 0, 0.03);color: #000;}
    .profile-dropdown .dropdown-item.text-danger:hover {background: rgba(220, 53, 69, 0.06);color: #dc3545;}
</style>