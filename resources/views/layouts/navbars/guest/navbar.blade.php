<div class="container position-sticky z-index-sticky top-0">
    <div class="row">
        <div class="col-12">
            <!-- Navbar -->
            <nav
                class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
                <div class="container-fluid">
                    <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="{{ route('home') }}">
                        Sistema de turnos <b  style="color:green">GRATIS</b>
                    </a>
                    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon mt-2">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </span>
                    </button>
                    <div class="collapse navbar-collapse" id="navigation">
                        <ul class="navbar-nav mx-auto">

                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page"
                                    href="https://api.whatsapp.com/send?phone=5493541530560">
                                    <i class="ri-whatsapp-line ri-xl opacity-6 text-dark me-1"></i>
                                    Whatsapp
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page"
                                    href="https://www.facebook.com/CrxnxsJJPV/">
                                    <i class="ri-facebook-fill ri-xl opacity-6 text-dark me-1"></i>
                                  
                                    Facebook
                                </a>
                            </li>


                           {{-- <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page"
                                    href="{{ route('home') }}">
                                    <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                                    Dashboard
                                </a>
                            </li>--}}
                            <li class="nav-item">
                                <a class="nav-link me-2" href="{{ route('register') }}">
                                    <i class="ri-user-line ri-xl opacity-6 text-dark me-1"></i>
                                    Registrar
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link me-2" href="{{ route('login') }}">
                
                                    <i class="ri-login-circle-line  ri-xl opacity-6 text-dark me-1" ></i>
                                    Ingresar
                                </a>
                            </li>
                        </ul>
                       {{--   <ul class="navbar-nav d-lg-block d-none">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/product/argon-dashboard-laravel" target="_blank"
                                    class="btn btn-sm mb-0 me-1 btn-primary">Free Download</a>
                            </li>
                        </ul>--}}
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>
    </div>
</div>
