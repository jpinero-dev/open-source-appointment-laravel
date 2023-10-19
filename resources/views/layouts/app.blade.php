<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="https://pinerov.com/images/32x32.webp">
    <title>{{ env('APP_NAME', 'Sistema de turnos') }}</title>


    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />



    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />

    <!-- CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Preahvihear&display=swap" rel="stylesheet">

</head>

<body class="{{ $class ?? '' }}">

    @include('sweetalert::alert')

    @guest
        @yield('content')
    @endguest

    @auth
        @if (in_array(request()->route()->getName(),
                ['sign-in-static', 'sign-up-static', 'login', 'register', 'recover-password', 'rtl', 'virtual-reality']))
            @yield('content')
        @else
            @if (
                !in_array(request()->route()->getName(),
                    ['profile', 'profile-static']))
                <div class="min-height-300 bg-primary position-absolute w-100" hidden></div>
            @elseif (in_array(request()->route()->getName(),
                    ['profile-static', 'profile']))
                <div class="position-absolute w-100 min-height-300 top-0"
                    style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg'); background-position-y: 50%;">
                    <span class="mask bg-primary opacity-6"></span>
                </div>
            @endif
            {{--  <canvas class="network-background-canvas"></canvas> --}}

            @if (!Route::is('turn.calendar'))
                @include('layouts.navbars.auth.sidenav')
            @endif



            <main class="main-content border-radius-lg">
                @yield('content')
            </main>
            @include('components.fixed-plugin')
        @endif
    @endauth

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->

    <style>
        .network-background-canvas {
            background: rgba(0, 0, 0, 0.15);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1000;
        }

        body {
            background-color: #232433;
        }
    </style>
    <script src="{{ asset('assets/js/argon-dashboard.js') }}"></script>

    <script>
        ((c) => {
            const options = {
                num: 40,
                particle: {
                    color: 'rgba(255,255,255,0.6)',
                    szMin: 0.5,
                    szMax: 1,
                    spMin: 0.05,
                    spMax: 0.5
                },
                link: {
                    color: 'rgba(255,255,255,0.3)',
                    maxDist: 120
                }
            };

            const pi2 = Math.PI * 2;
            const degrad = Math.PI / 180.0;
            const ctx = c.getContext('2d');
            let w = c.width = window.innerWidth;
            let h = c.height = window.innerHeight;

            class Particle {
                constructor() {
                    this.p = {
                        x: Math.random() * c.width,
                        y: Math.random() * c.height
                    };
                    this.s = options.particle.spMin + Math.random() * options.particle.spMax;
                    this.r = options.particle.szMin + Math.random() * options.particle.szMax;
                    this.d = Math.random() * pi2;
                    this.v = {
                        x: Math.cos(this.d) * this.s,
                        y: Math.sin(this.d) * this.s
                    };
                }
                setDir(d) {
                    this.d = d;
                    this.v.x = Math.cos(this.d) * this.s;
                    this.v.y = Math.sin(this.d) * this.s;
                }
                wrap() {
                    if (this.p.x < 0 || this.p.x > w || this.p.y < 0 || this.p.y > h)
                        this.setDir(this.d + Math.random() * degrad * 5);
                    if (this.p.x < 0) this.p.x += w;
                    if (this.p.x > w) this.p.x -= w;
                    if (this.p.y < 0) this.p.y += h;
                    if (this.p.y > h) this.p.y -= h;
                }
                update() {
                    this.p.x += this.v.x;
                    this.p.y += this.v.y;
                    this.wrap();
                }
                draw() {
                    ctx.beginPath();
                    ctx.arc(this.p.x, this.p.y, this.r, 0, pi2);
                    ctx.fillStyle = options.particle.color;
                    ctx.fill();
                }
                drawLink(other) {
                    ctx.save();
                    ctx.globalAlpha = 1 - (this.distanceTo(other) / options.link.maxDist);
                    ctx.beginPath();
                    ctx.moveTo(this.p.x, this.p.y);
                    ctx.lineWidth = this.r;
                    ctx.lineTo(other.p.x, other.p.y);
                    ctx.strokeStyle = options.link.color;
                    ctx.stroke();
                    ctx.restore();
                }
                closeTo(other) {
                    let xd = other.p.x - this.p.x;
                    let yd = other.p.y - this.p.y;

                    return (xd * xd + yd * yd) <= (options.link.maxDist * options.link.maxDist);
                }
                distanceTo(other) {
                    let xd = other.p.x - this.p.x;
                    let yd = other.p.y - this.p.y;

                    return Math.sqrt(xd * xd + yd * yd);
                }
            }

            const particles = [...Array(options.num)].map((_, i) => new Particle);

            const resize = () => {
                let s = {
                    x: window.innerWidth / w,
                    y: window.innerHeight / h
                };
                w = c.width = window.innerWidth;
                h = c.height = window.innerHeight;
                particles.forEach((particle) => {
                    particle.p.x *= s.x;
                    particle.p.y *= s.y;
                    particle.draw();
                });
            };

            let integrate = () => {
                ctx.clearRect(0, 0, w, h);
                particles.forEach((a) => {
                    a.update();
                    a.draw();
                    particles.forEach((b) => {
                        if (a === b || !b.closeTo(a)) return;
                        a.drawLink(b);
                    });

                });
                window.requestAnimationFrame(integrate);
            };

            const init = () => {
                c.classList.add('network-background-canvas');


                document.body.insertAdjacentElement('beforeend', c);
                resize();
                window.addEventListener('resize', resize);
                window.requestAnimationFrame(integrate);
            };

            document.addEventListener('DOMContentLoaded', init);
        })(document.createElement('canvas'));
    </script>

    @stack('js');
</body>

</html>
