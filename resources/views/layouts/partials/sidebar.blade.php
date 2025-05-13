<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
  <div class="sidenav-header text-center py-4">
    <h4 class="mb-1">Tracer Study</h4>
    <p class="text-sm mb-0">Polinema</p>
  </div>
  <hr class="horizontal dark mt-0" />

  @if(Session::get('level') == 'Alumni')
  <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('index') ? 'active' : '' }}" href="{{ url('/index') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-tv-2 text-sm opacity-10 {{ Request::is('index') ? 'text-white' : 'text-dark' }}"></i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('profile') ? 'active' : '' }}" href="{{ url('/profile') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-single-02 text-sm opacity-10 {{ Request::is('profile') ? 'text-white' : 'text-dark' }}"></i>
          </div>
          <span class="nav-link-text ms-1">Profile</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('form') ? 'active' : '' }}" href="{{ url('/form') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-single-copy-04 text-sm opacity-10 {{ Request::is('form') ? 'text-white' : 'text-dark' }}"></i>
          </div>
          <span class="nav-link-text ms-1">Form</span>
        </a>
      </li>
    </ul>
  </div>
  @elseif(Session::get('level') == 'Admin')
  <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/index') ? 'active' : '' }}" href="{{ url('/admin/index') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-tv-2 text-sm opacity-10 {{ Request::is('admin/index') ? 'text-white' : 'text-dark' }}"></i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/daftarAlumni') ? 'active' : '' }}" href="{{ url('/admin/daftarAlumni') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-single-02 text-sm opacity-10 {{ Request::is('admin/daftarAlumni') ? 'text-white' : 'text-dark' }}"></i>
          </div>
          <span class="nav-link-text ms-1">Data Alumni</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/laporan') ? 'active' : '' }}" href="{{ url('/admin/laporan') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-single-copy-04 text-sm opacity-10 {{ Request::is('admin/laporan') ? 'text-white' : 'text-dark' }}"></i>
          </div>
          <span class="nav-link-text ms-1">Laporan</span>
        </a>
      </li>
    </ul>
  </div>
  @endif
</aside>
