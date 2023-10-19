@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Categorias de turnos'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 p-3">

                </div>

                <div class="card-body">
                    <p class="text-uppercase text-sm">Registro de Categoria de turnos</p>
                    @if (isset($data))
                        <form method="POST" action="{{ route('turntype.update', ['id' => $data->id]) }}">
                    @else
                        <form method="POST" action="{{ route('turntype.store') }}">
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="prefix" class="form-control-label">Prefijo</label>
                                <input class="form-control" type="text" id="prefix" name="prefix"
                                    value="{{ old('prefix', $data->prefix ?? '') }}" onfocus="focused(this)"
                                    onfocusout="defocused(this)">
                                @error('prefix')
                                    <p class="text-danger text-xs pt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Nombre</label>
                                <input class="form-control" type="text" id="name" name="name"
                                    value="{{ old('name', $data->name ?? '') }}" onfocus="focused(this)"
                                    onfocusout="defocused(this)">
                                @error('name')
                                    <p class="text-danger text-xs pt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description" class="form-control-label">Description</label>
                                <textarea class="form-control" id="description" name="description" onfocus="focused(this)" onfocusout="defocused(this)"> {{ old('description', $data->description ?? '') }} </textarea>
                                @error('description')
                                    <p class="text-danger text-xs pt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="text-center">

                            <button type="submit" class="btn btn-icon btn-3  btn-sm  btn-primary mb-0">
                                {{ isset($data) ? 'Actualizar' : 'Registrar' }}
                            </button>
                        </div>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    @endsection
