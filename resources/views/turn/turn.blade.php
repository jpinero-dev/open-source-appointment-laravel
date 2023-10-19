@extends('layouts.app')

@section('content')
    {{--   @include('layouts.navbars.guest.navbar') --}}
    <main class="main-content  mt-4">


        <div class="container-fluid">
            <div class="row" style="height: 100vh;">

                @if (!empty($multimedia) && count($multimedia) > 0)
                    <style>
                        body {
                            overflow: hidden;
                        }
                    </style>
                    
                    <div class="col-xl-7 col-lg-4 col-md-4 mx-auto pt-2" style="height: 100vh;">
                        <div class="card z-index-0 d-flex flex-column" style="height: 90vh; overflow: hidden; padding: 0; margin: 0;">
                            <div id="myCarousel" class="carousel slide" data-bs-ride="carousel"
                                style="height: 100% !important;">
                                <div class="carousel-inner" style="height: 100% !important;">
                                    @foreach ($multimedia as $index => $multi)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}"
                                            style="height: 100% !important;">
                                            <img src="{{ asset($multi->url) }}" alt=""
                                                style=" object-fit: cover;
                                            width: 100%;
                                            height: 100%;
                                            margin: 0;">
                                        </div>
                                    @endforeach

                                </div>
                                <a class="carousel-control-prev" href="#myCarousel" role="button" data-bs-slide="prev"
                                    hidden>
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#myCarousel" role="button" data-bs-slide="next"
                                    hidden>
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </a>
                            </div>


                            <!-- Contenedor para el reloj -->
                            <div class="text-center" style="position: absolute; bottom: 0; left: 0; width: 100%;">
                                <div id="clock" class=" font-weight-bold " style="padding: 10px;font-size:40px;color:black">
                                   
                                </div>
                            </div>
                        </div>
                      



                    </div>
                    
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                @endif

              
                <style>
                    .turns-container {
                        max-height: 90vh; /* Ajusta la altura máxima deseada */
                        overflow: hidden;
                        position: relative;
                        transition: max-height 0.5s ease-out; /* Duración y función de transición */
                    }

                    .turns-container.expanded {
                        max-height: none;
                        transition: max-height 0.5s ease-in-out; /* Duración y función de transición */
                    }
                </style>
                <div class="col-xl-5 col-lg-8 col-md-8 mx-auto pt-2">
                    @if (!empty($data) && count($data) > 0)
                        <div id="turnsContainer" class="turns-container" >
                            @foreach ($data as $item)
                                <div class="card z-index-0 mb-3">
                                    <div class="card-body">
                                        <ul class="list-group">
                                            <li class="list-group-item border-0 d-flex   border-radius-lg">
                                                <div class="col-md-2">
                                                    <div class="card card-body border  bg-primary  d-flex justify-content-center align-items-center flex-row">
                                                        <h4 class="text-white">
                                                            {{ $item->turnType->prefix }}{{ $item->number }}
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="col-md-7 d-flex flex-column justify-content-start align-items-start " style="padding-left:30px">
                                                    <h4 class="text-dark">{{ $item->name }}</h4>
                                                    <h4 class="text-dark">{{ \Carbon\Carbon::parse($item->start_datetime)->format('H:i')  }}</h4>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="d-flex align-items-center justify-content-center text-primary text-gradient text-sm font-weight-bold" style="height: 100%">
                                                        <h3>{{ $item->module->name }}</h3>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>



    </main>
    @include('layouts.footers.guest.footer')
@endsection
@push('js')
<script>

// Obtén el contenedor de los elementos
var turnsContainer = document.getElementById('turnsContainer');

// Calcula la altura total de los elementos dentro del contenedor
var totalHeight = turnsContainer.scrollHeight;

// Definir la velocidad y la dirección del autoscroll
var scrollSpeed = 1; // Cuanto menor sea el número, más rápido será el scroll
var scrollDirection = 1; // 1 para desplazarse hacia abajo, -1 para desplazarse hacia arriba

// Función para realizar el autoscroll
function autoScroll() {
    turnsContainer.scrollTop += scrollSpeed * scrollDirection;

    // Cambiar la dirección si llegamos al final o al principio
    if (turnsContainer.scrollTop >= totalHeight - turnsContainer.clientHeight) {
        scrollDirection = -1; // Cambiar la dirección a arriba
    } else if (turnsContainer.scrollTop <= 0) {
        scrollDirection = 1; // Cambiar la dirección a abajo
    }
}

// Intervalo de tiempo para ejecutar el autoscroll
setInterval(autoScroll, 50); // Ajusta el intervalo según tus preferencias


    function updateClock() {
        const clockElement = document.getElementById('clock');
        const currentTime = new Date();

        const hours = currentTime.getHours().toString().padStart(2, '0');
        const minutes = currentTime.getMinutes().toString().padStart(2, '0');
        const seconds = currentTime.getSeconds().toString().padStart(2, '0');

        const formattedTime = `${hours}:${minutes}:${seconds}`;
        clockElement.textContent = formattedTime;
    }

    // Actualizar cada segundo
    setInterval(updateClock, 1000);

    // Llamar a la función para mostrar la hora actual
    updateClock();
</script>

    
@endpush


@push('js')
<script>
    function fetchTurnData() {

        // Realiza una petición AJAX a la API
        fetch('/turnos/calendarioAPI')
            .then(response => response.json())
            .then(data => {
                // Genera el contenido HTML a partir de los datos obtenidos
                let content = '';
                if (data.length > 0) {
                    console.table(data);
                    data.forEach(item => {

                        content += `
                        <div class="card z-index-0 mb-3">
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                        <div class="col-md-2">
                                            <div class="card card-body border bg-primary d-flex justify-content-center align-items-center flex-row">
                                                <h4 class="text-white">
                                                    ` + item.turn_type.prefix + item.number + `
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="col-md-7 d-flex flex-column justify-content-start align-items-start" style="padding-left:30px">
                                            <h4 class="text-dark">` + item.name + `</h4>
                                            <h4 class="text-dark">` + item.start_datetime.substring(11, 16) + `</h4>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="d-flex align-items-center justify-content-center text-primary text-gradient text-sm font-weight-bold" style="height: 100%">
                                                <h3>` + item.module.name + `</h3>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    `;


                    });
                }

                // Actualiza el contenido en el contenedor
                document.getElementById('turnsContainer').innerHTML = content;
            })
            .catch(error => console.error(error));
    }
    setTimeout(() => {
        // Ejecuta la función al cargar la página y luego cada minuto
        //  fetchTurnData();
        setInterval(fetchTurnData, 6000); // 60000 milisegundos = 1 minuto
    }, 6000); // 60000 milisegundos = 1 minuto
</script>
@endpush