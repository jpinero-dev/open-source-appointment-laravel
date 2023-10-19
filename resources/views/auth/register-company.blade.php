@extends('layouts.app')

@section('content')
    {{-- @include('layouts.navbars.guest.navbar') --}}
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-45 pt-0 m-3 border-radius-lg">
            <span class="mask opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">¡Segundo Paso para Registro!</h1>


                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <table class="table align-items-center mb-0">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSTV6Qw8LEKxaOSBzAVdBPKmhmeVtFZoC8CuA&usqp=CAU"
                                                    class="avatar avatar-sm me-3">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-xs">{{ $userData['username'] }}</h6>
                                                <p class="text-xs text-secondary mb-0">{{ $userData['email'] }}</p>
                                            </div>
                                        </div>
                                    </td>

                                </tr>

                            </tbody>
                        </table>
                        <hr>
                        <div class="card-header text-center pt-4">
                            <h5>Datos de tu negocio</h5>
                        </div>


                        <div class="card-body">

                            <form method="POST" action="{{ route('register.perform2') }}">
                                @csrf



                                <!-- Agregar los campos del formulario de la empresa -->

                                <div class="flex flex-col mb-3">
                                    <input type="text" name="identification" class="form-control"
                                        placeholder="DNI / Cédula / Pasaporte / RUC"
                                        aria-label="DNI / Cédula / Pasaporte / RUC" value="{{  $inputData['identification'] ?? ''  }}">
                                        @if ($errors->has('identification'))
                                        <p class='text-danger text-xs pt-1'> {{ $errors->first('identification') }} </p>
                                        @endif
                                </div>

                                <div class="flex flex-col mb-3">
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Nombre de la empresa" aria-label="Nombre de la empresa"
                                        value="{{  $inputData['name'] ?? ''  }}">
                                    @if ($errors->has('name'))
                                        <p class='text-danger text-xs pt-1'> {{ $errors->first('name') }} </p>
                                    @endif
                                </div>
                                <div class="flex flex-col mb-3">
                                    <input type="text" name="address" class="form-control"
                                        placeholder="Dirección de la empresa" aria-label="Dirección de la empresa"
                                        value="{{  $inputData['address'] ?? ''  }}">
                                        @if ($errors->has('address'))
                                        <p class='text-danger text-xs pt-1'> {{ $errors->first('address') }} </p>
                                        @endif
                                </div>
                                <div class="flex flex-col mb-3">
                                    <input type="text" name="phone" class="form-control"
                                        placeholder="Teléfono de la empresa" aria-label="Teléfono de la empresa"
                                        value="{{ $inputData['phone'] ?? '' }}">
                                        @if ($errors->has('phone'))
                                        <p class='text-danger text-xs pt-1'> {{ $errors->first('phone') }} </p>
                                        @endif
                                </div>
                                <div class="flex flex-col mb-3">
                                    <textarea name="description" class="form-control" placeholder="Descripción de la empresa"
                                        aria-label="Descripción de la empresa">{{ $inputData['description'] ?? '' }}</textarea>
                                        @if ($errors->has('description'))
                                        <p class='text-danger text-xs pt-1'> {{ $errors->first('description') }} </p>
                                        @endif
                                </div>
                                <!-- Fin de los campos del formulario de la empresa -->
                                <div class="text-center">
                                    <input type="hidden" name="userData" value="{{ json_encode($userData) }}">
                                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Registrarse</button>
                                </div>
                                <p class="text-sm mt-3 mb-0">¿Ya tienes una cuenta? <a href="{{ route('login') }}"
                                        class="text-dark font-weight-bolder">Iniciar sesión</a></p>
                            </form>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('layouts.footers.guest.footer')
@endsection
