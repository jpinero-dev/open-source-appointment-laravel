<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}"
            target="_blank">
            <img src="https://pinerov.com/images/32x32.webp" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Sistema de turnos</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                      {{--  <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i> --}} 
                      <img src="https://img.icons8.com/?size=512&id=SROvvC91x7DL&format=png" width="30" alt="">
                      
                    </div>
                    <span class="nav-link-text ms-1">Panel</span>
                </a>
            </li>

            <li class="nav-item mt-3 d-flex align-items-center">
                <div class="ps-4">
                    <i class="ri-arrow-right-s-fill"></i>
               
                </div>
                <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Multimedia</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'multimedia' ? 'active' : '' }}" href="{{ route('multimedia') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                     
                        {{-- <i class="ri-hourglass-line ri-xl text-muted text-sm opacity-10" style="font-weight: 300;"></i> --}}
                        <img src="https://img.icons8.com/?size=512&id=13982&format=png" width="30" alt="">

                    </div>
                    <span class="nav-link-text ms-1">Multimedia</span>
                </a>
            </li>


            <li class="nav-item mt-3 d-flex align-items-center">
                <div class="ps-4">
                    <i class="ri-arrow-right-s-fill"></i>
               
                </div>
                <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Turnos</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'turntype' ? 'active' : '' }}" href="{{ route('turntype') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="https://img.icons8.com/?size=512&id=18714&format=png" width="30" alt="">
                      
                      

                    </div>
                    <span class="nav-link-text ms-1">Categoria de turnos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'module' ? 'active' : '' }}" href="{{ route('module') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                     
                        {{-- <i class="ri-hourglass-line ri-xl text-muted text-sm opacity-10" style="font-weight: 300;"></i> --}}
                        <img src="https://img.icons8.com/?size=512&id=Gb7VEgIx8KIg&format=png" width="30" alt="">

                    </div>
                    <span class="nav-link-text ms-1">Modulos de atención</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'turn' ? 'active' : '' }}" href="{{ route('turn') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                       
                   <img src="https://img.icons8.com/?size=512&id=15640&format=png" width="30" alt="">
                      
                    </div>
                    <span class="nav-link-text ms-1">Turnos</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'calendar' ? 'active' : '' }}" href="{{ route('turn.calendar') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                       
                   <img src="https://img.icons8.com/?size=512&id=114319&format=png" width="30" alt="">
                      
                    </div>
                    <span class="nav-link-text ms-1">Ventana</span>
                </a>
            </li>

          {{--    <li class="nav-item mt-3 d-flex align-items-center">
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
                <a class="nav-link {{ Route::currentRouteName() == 'virtual-reality' ? 'active' : '' }}" href="{{ route('virtual-reality') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-app text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Virtual Reality</span>
                </a>
            </li>
           
           --}}

           
        </ul>
    </div>
    <div class="sidenav-footer mx-3 " hidden>
        <div class="card card-plain shadow-none" id="sidenavCard">
            <img class="w-50 mx-auto" src="/img/illustrations/icon-documentation-warning.svg"
                alt="sidebar_illustration">
            <div class="card-body text-center p-3 w-100 pt-0">
                <div class="docs-info">
                    <h6 class="mb-0">Necesitas Ayuda?</h6>
                    <p class="text-xs font-weight-bold mb-0">Contactame</p>
                </div>
            </div>
        </div>
        <a href="/docs/bootstrap/overview/argon-dashboard/index.html" target="_blank"
            class="btn btn-dark btn-sm w-100 mb-3">Documentation</a>
      
    </div>
</aside>
