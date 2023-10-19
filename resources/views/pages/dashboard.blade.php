@extends('layouts.app', ['class' => 'g-sidenav-show '])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">

                            <div class="col-12">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Turnos Hoy</p>
                                    <h5 class="font-weight-bolder">
                                        {{ isset($turnsCounts['turnsToday']) ? $turnsCounts['turnsToday'] : 0 }}
                                    </h5>
                                    <p class="mb-0" hidden>
                                        <span class="text-success text-sm font-weight-bolder">+55%</span>
                                        since yesterday
                                    </p>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Turnos ultimos 7 dias</p>
                                    <h5 class="font-weight-bolder">
                                        {{ isset($turnsCounts['turnsLastSevenDays']) ? $turnsCounts['turnsLastSevenDays'] : 0 }}
                                    </h5>
                                    <p class="mb-0" hidden>
                                        <span class="text-success text-sm font-weight-bolder">+3%</span>
                                        since last week
                                    </p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Turnos ultimos 30 dias</p>
                                    <h5 class="font-weight-bolder">
                                        {{ isset($turnsCounts['turnsLastMonth']) ? $turnsCounts['turnsLastMonth'] : 0 }}
                                    </h5>
                                    <p class="mb-0" hidden>
                                        <span class="text-danger text-sm font-weight-bolder">-2%</span>
                                        since last quarter
                                    </p>
                                </div>
                            </div>
                         
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Turnos ultimo año</p>
                                    <h5 class="font-weight-bolder">
                                        {{ isset($turnsCounts['turnsLastYear']) ? $turnsCounts['turnsLastYear'] : 0 }}
                                    </h5>
                                    <p class="mb-0" hidden>
                                        <span class="text-success text-sm font-weight-bolder">+5%</span> than last month
                                    </p>
                                </div>
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Turnos este año</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-time text-success"></i>
                            <span class="font-weight-bold">{{ date('Y') }}</span> año actual
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card card-carousel overflow-hidden h-100 p-0">
                    <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                        <div class="carousel-inner border-radius-lg h-100">
                           
                           
                            @if (!empty($turnsCounts['multimedia']) && count($turnsCounts['multimedia']) > 0)
                                @foreach ($turnsCounts['multimedia'] as $index => $multi)
                                <div class="carousel-item h-100 {{ $index === 0 ? 'active' : '' }}" style="background-image: url('{{ asset($multi->url) }}');
                                background-size: cover;">
                                                    <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                                        <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                                         <a href="{{ route('multimedia') }}" class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                                            <i class="ni ni-camera-compact text-dark opacity-10"></i>
                                                              </a>
                                                        </div>
                                                       
                                                    </div>
                                                </div>
                                @endforeach
                            @else
<div class="carousel-item h-100 active" >
    <img src="{{ asset('img/empty.png') }}" alt="Imagen" class="w-100 h-100" style="object-fit: cover;">
                                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                                    <a href="{{ route('multimedia.create') }}" class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                                     
                                                        <i class="ri-add-line  text-dark opacity-10"></i>
                                                    </a>

                                                   
                                                    
                                                </div>
                                            </div>

                            @endif
                          
                  
                           
                        </div>
                        <button class="carousel-control-prev w-5 me-3" type="button"
                            data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next w-5 me-3" type="button"
                            data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Ultimos turnos agregados</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center ">
                            <tbody>

                                @if (!empty($turnsCounts['lastTurns']))
                                @foreach ($turnsCounts['lastTurns'] as $lastTurns)
                                    @php
                                        $turnData = json_decode($lastTurns, true);
                                        $turnType = $turnData['turn_type'];
                                    @endphp
                            
                                    <tr>
                                        <td class="w-30">
                                            <div class="d-flex px-2 py-1 align-items-center">
                                                <div class="ms-4">
                                                    <p class="text-xs font-weight-bold mb-0">Turno</p>
                                                    <h6 class="text-sm mb-0">{{ $turnType['prefix'] }}{{ $turnData['number'] }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Módulo</p>
                                                <h6 class="text-sm mb-0">{{ $turnData['module']['name'] }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Nombre</p>
                                                <h6 class="text-sm mb-0">{{ $turnData['name'] }}</h6>
                                            </div>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <div class="col text-center">
                                                <p class="text-xs font-weight-bold mb-0">Fecha y hora</p>
                                                <h6 class="text-sm mb-0">{{ \Carbon\Carbon::parse($turnData['start_datetime'])->format('d-m-Y H:i') }}</h6>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                <tr>
                   
                                 
                                    <td colpasn="4" class="align-middle text-sm">
                                        <div class="col text-center">
                                            
                                            <h6 class="text-sm mb-0">No se han registrado turnos.</h6>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            
                             
 
  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Total de turnos por estado</h6>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group">
                          

                         
                           @if (!empty($turnsCounts['totalsByStatus']) && count($turnsCounts['totalsByStatus']) > 0)
                          
                            @foreach ($turnsCounts['totalsByStatus'] as $status => $total)
                                @php
                                    $translatedStatus = $statusTranslations[$status];
                                    $statusIcon = $statusIcons[$status];
                                @endphp

                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                            <i class="ni {{ $statusIcon }} text-white opacity-10"></i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">{{ $total }}   {{ $translatedStatus }} </h6>
                                            <span class="text-xs">Se encontraron {{ $total }} turnos como, <span class="font-weight-bold">  {{ $translatedStatus }}</span></span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <a href="{{ route('turn') }}" class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto">
                                            <i class="ni ni-bold-right" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </li>
                            @endforeach

                           @else
                          
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                        <i class="ni ni-satisfied text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Sin registros</h6>
                                        <span class="text-xs font-weight-bold">0</span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <a href="{{ route('turn') }}"
                                        class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                            class="ni ni-bold-right" aria-hidden="true"></i></a>
                                </div>
                            </li>
                             @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@if (isset($turnsCounts['monthlyTotals']))
@push('js')
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        var monthlyTotals = <?php echo json_encode($turnsCounts['monthlyTotals']); ?>;
        var spanishMonths = [
        "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
    ];

        gradientStroke1.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(251, 99, 64, 0)');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: monthlyTotals.map(entry => spanishMonths[entry.month - 1]), // Usamos los nombres en español
                datasets: [{
                    label: "Turnos",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#2c2d40",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: monthlyTotals.map(entry => entry.total_turns),
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
@endpush
@endif