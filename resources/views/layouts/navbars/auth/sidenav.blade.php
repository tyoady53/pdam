<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}">
            <img src="../img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Test Enchencement</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-3 d-flex align-items-center">
                <div class="ps-4">
                    {{-- <i class="fab fa-laravel" style="color: #f4645f;"></i> --}}
                </div>
                <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Test</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'mulitple_choice' ? 'active' : '' }}" href="{{ route('test-mulitple_choice') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <svg fill="#000000" height="50px" width="50px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 488 488" xml:space="preserve">
                            <g transform="translate(0 -540.36)">
                                <g>
                                    <g>
                                        <path d="M448.9,666.06c0-0.1-0.1-0.3-0.1-0.4c0-0.2-0.1-0.3-0.1-0.5c0-0.1-0.1-0.3-0.1-0.4c-0.1-0.2-0.1-0.3-0.2-0.5
                                            c0-0.1-0.1-0.3-0.1-0.4c-0.1-0.3-0.2-0.5-0.4-0.8c-0.1-0.1-0.1-0.2-0.2-0.3c-0.1-0.2-0.2-0.3-0.3-0.5c-0.1-0.1-0.1-0.2-0.2-0.3
                                            c-0.1-0.1-0.1-0.2-0.2-0.3l-90-117.4l-0.1-0.1c-0.2-0.2-0.3-0.4-0.5-0.6c-0.1-0.1-0.1-0.2-0.2-0.2c-0.2-0.3-0.5-0.5-0.8-0.7
                                            c0,0,0,0-0.1-0.1c-0.3-0.2-0.5-0.4-0.8-0.6c-0.1-0.1-0.2-0.1-0.3-0.2c-0.2-0.1-0.4-0.3-0.7-0.4c-0.1,0-0.2-0.1-0.3-0.1
                                            c-0.2-0.1-0.5-0.2-0.7-0.3c-0.1,0-0.2-0.1-0.3-0.1c-0.2-0.1-0.5-0.2-0.7-0.2c-0.1,0-0.2-0.1-0.3-0.1c-0.3-0.1-0.5-0.1-0.8-0.1
                                            c-0.1,0-0.2,0-0.3,0c-0.4,0-0.7-0.1-1.1-0.1H49c-5.5,0-10,4.5-10,10v468c0,5.5,4.5,10,10,10h390c5.5,0,10-4.5,10-10v-350.6
                                            c0-0.2,0-0.5,0-0.8v0c0-0.1,0-0.2,0-0.3C449,666.46,448.9,666.26,448.9,666.06z M418.7,657.86h-59.5l-0.2-77.8L418.7,657.86z
                                            M429,1008.46H59v-448h280l0.2,107.4c0,5.5,4.5,10,10,10H429V1008.46z"/>
                                        <path d="M101.3,723.46c0,5.5,4.5,10,10,10h266.2c5.5,0,10-4.5,10-10s-4.5-10-10-10H111.3C105.8,713.46,101.3,717.96,101.3,723.46
                                            z"/>
                                        <path d="M111.3,672.46h173.9h0c5.5,0,9.9-4.5,9.9-10s-4.5-10-10-10H111.3c-5.5,0-10,4.5-10,10S105.8,672.46,111.3,672.46z"/>
                                        <path d="M111.3,794.46h266.2c5.5,0,10-4.5,10-10s-4.5-10-10-10H111.3c-5.5,0-10,4.5-10,10S105.8,794.46,111.3,794.46z"/>
                                        <path d="M285.2,855.46c5.5,0,9.9-4.5,9.9-10s-4.5-10-10-10H111.3c-5.5,0-10,4.5-10,10s4.5,10,10,10H285.2L285.2,855.46z"/>
                                        <path d="M370.9,868.26l-84.2,74.4l-24.3-32.5c-3.3-4.4-9.6-5.3-14-2c-4.4,3.3-5.3,9.6-2,14l30.8,41.2c1.7,2.3,4.2,3.7,7,4
                                            c0.3,0.1,0.7,0.1,1,0.1l0,0c2.4,0,4.7-0.9,6.6-2.6l92.3-81.6c4.2-3.6,4.6-10,0.9-14.1C381.4,864.96,375,864.56,370.9,868.26z"/>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Multiple Choice Test</span>
                </a>
            </li>
            {{-- <li class="nav-item mt-3 d-flex align-items-center">
                <div class="ps-4">
                    <i class="fab fa-laravel" style="color: #f4645f;"></i>
                </div>
                <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Laravel Examples</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}" href="{{ route('profile') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'user-management') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'user-management']) }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">User Management</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'tables') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'tables']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Tables</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{  str_contains(request()->url(), 'billing') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'billing']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Billing</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'virtual-reality' ? 'active' : '' }}" href="{{ route('virtual-reality') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-app text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Virtual Reality</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'rtl' ? 'active' : '' }}" href="{{ route('rtl') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">RTL</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'profile-static' ? 'active' : '' }}" href="{{ route('profile-static') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('sign-in-static') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Sign In</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('sign-up-static') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-collection text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Sign Up</span>
                </a>
            </li> --}}
        </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
        {{-- <div class="card card-plain shadow-none" id="sidenavCard">
            <img class="w-50 mx-auto" src="/img/illustrations/icon-documentation-warning.svg"
                alt="sidebar_illustration">
            <div class="card-body text-center p-3 w-100 pt-0">
                <div class="docs-info">
                    <h6 class="mb-0">Need help?</h6>
                    <p class="text-xs font-weight-bold mb-0">Please check our docs</p>
                </div>
            </div>
        </div> --}}
        {{-- <a href="/docs/bootstrap/overview/argon-dashboard/index.html" target="_blank"
            class="btn btn-dark btn-sm w-100 mb-3">Documentation</a>
        <a class="btn btn-primary btn-sm mb-0 w-100"
            href="https://www.creative-tim.com/product/argon-dashboard-pro-laravel" target="_blank" type="button">Upgrade to PRO</a> --}}
    </div>
</aside>