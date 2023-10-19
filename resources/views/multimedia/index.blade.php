@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Listado de turnos'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">



                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">

                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('multimedia.create') }}" class="btn btn-icon btn-3  btn-sm  btn-primary mb-0">
                                <span class="btn-inner--text">Agregar</span>
                            </a>

                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Vista Previa</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                        Tipo
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        URL</th>

                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($data) > 0)
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset($item->url) }}" class="avatar avatar-sm me-3"
                                                            alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $item->type }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $item->url }}</p>
                                                        </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-sm  mb-0"> {{ $item->type }}</p>
                                            </td>


                                            <td class="align-middle text-center text-sm">
                                                <p class="text-sm  mb-0">{{ $item->url }}</p>
                                            </td>

                                            <td class="align-middle text-end">
                                                <div class="ms-auto text-end">
                                                    <a href="{{ route('multimedia.delete', $item->id) }}"
                                                        class="btn btn-sm  btn-outline-danger"> <i
                                                            class="far fa-trash-alt me-2" aria-hidden="true"></i>
                                                        Eliminar</a>
                                                    <a class="btn  btn-sm btn-outline-dark"
                                                        href="{{ route('multimedia.edit', ['id' => $item->id]) }}">
                                                        <i class="fas fa-pencil-alt text-dark me-2  "
                                                            aria-hidden="true"></i>Editar
                                                    </a>
                                                </div>
                    </div>


                    </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="mb-0 text-sm text-center">
                            No tienes Registros.
                            <br>

                            <a href="{{ route('multimedia.create') }}" class="btn btn-outline-dark mt-2 btn-sm mb-0">
                                <i class="ri-add-line"></i>
                                Agregar un registro
                            </a>

                        </td>
                    </tr>
                    @endif

                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
