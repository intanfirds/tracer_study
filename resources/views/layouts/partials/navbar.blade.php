<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
            <ul class="navbar-nav align-items-end">
                <!-- Logout Button -->
                <li class="nav-item d-flex align-items-center me-2">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-sm mb-0"
                            style="background: #354764; color: white; min-width: 120px; padding: 8px 16px; border-radius: 5px;">
                            <i class="fas fa-sign-out-alt me-2"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>

                <!-- Sidebar Toggle -->
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    @media (max-width: 991.98px) {
        .navbar-collapse {
            background: transparent !important;
            position: relative !important;
            margin-top: 0 !important;
        }

        .navbar-nav {
            flex-direction: row !important;
            justify-content: flex-end !important;
            align-items: center !important;
            width: 100%;
            margin: 0 !important;
        }

        #navbar {
            display: flex !important;
            justify-content: flex-end !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .nav-item {
            margin-bottom: 0 !important;
        }
    }
</style>
