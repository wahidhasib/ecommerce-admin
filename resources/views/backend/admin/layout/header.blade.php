<!--begin::Start Navbar Links-->
<ul class="navbar-nav header-nav">
    <li class="nav-item">
        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
            <i class="bi bi-list text-white"></i>
        </a>
    </li>
    <li class="nav-item d-none d-md-block">
        <a href="#" class="nav-link text-white">Home</a>
    </li>
    <li class="nav-item d-none d-md-block">
        <a href="#" class="nav-link text-white">Contact</a>
    </li>
</ul>
<!--end::Start Navbar Links-->

<!--begin::End Navbar Links-->
<ul class="navbar-nav ms-auto">
    <!--begin::Navbar Search-->
    {{-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="bi bi-search"></i>
        </a>
    </li> --}}
    <!--end::Navbar Search-->

    <!--begin::Fullscreen Toggle-->
    <li class="nav-item">
        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen text-white"></i>
            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit text-white" style="display: none"></i>
        </a>
    </li>
    <!--end::Fullscreen Toggle-->

    <!--begin::User Menu Dropdown-->
    <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
            <img src="{{ URL::asset('assets/backend/assets/img/user2-160x160.jpg') }}"
                class="user-image rounded-circle shadow" alt="User Image" />
            <span class="d-none d-md-inline text-white">Alexander Pierce</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
            <!--begin::User Image-->
            <li class="user-header">
                <img src="{{ URL::asset('assets/backend/assets/img/user2-160x160.jpg') }}" class="rounded-circle shadow"
                    alt="User Image" />
                <p>
                    Alexander Pierce - Web Developer
                    <small>Member since Nov. 2023</small>
                </p>
            </li>
            <!--end::User Image-->
            <!--begin::Menu Footer-->
            <li class="user-footer d-flex">
                <div class="">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <form action="{{ route('logout', Auth::id()) }}" method="POST" class="ms-auto">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-default btn-flat">Sign out</button>
                </form>
            </li>
            <!--end::Menu Footer-->
        </ul>
    </li>
    <!--end::User Menu Dropdown-->
</ul>
<!--end::End Navbar Links-->
