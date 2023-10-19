@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Registro de turnos'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 p-3">

                </div>

                <div class="card-body">
                    <p class="text-uppercase text-sm">Registro de turnos</p>
                    @if (isset($data))
                        <form method="POST" action="{{ route('turn.update', ['id' => $data->id]) }}">
                        @else
                            <form method="POST" action="{{ route('turn.store') }}">
                    @endif
                    @csrf
                    <div class="row">
                        @if (isset($data))
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status" class="form-control-label">Estado</label>
                                    <select class="form-select" name="status" id="status">
                                        @foreach ($statusOptions as $value => $label)
                                            <option value="{{ $value }}"
                                                {{ old('status', isset($data) && $data->status == $value ? 'selected' : '') }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12" id="cancellation_reason">
                                <div class="form-group">
                                    <label for="cancellation_reason" class="form-control-label">Motivo de
                                        cancelación</label>
                                    <textarea class="form-control" name="cancellation_reason" id="cancellation_reason">{{ old('cancellation_reason', $data->cancellation_reason ?? '') }}</textarea>
                                    @error('cancellation_reason')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Otros contenidos de la vista -->

                            <!-- Otros contenidos de la vista -->

                            @push('js')
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        var statusSelect = document.getElementById("status");
                                        var cancellationReason = document.getElementById("cancellation_reason");

                                        // Verificar el estado inicial y mostrar/ocultar el campo de motivo
                                        if (statusSelect.value === "cancelled") {
                                            cancellationReason.style.display = "block";
                                        } else {
                                            cancellationReason.style.display = "none";
                                            cancellationReason.value = ""; // Limpiar el contenido del campo
                                        }

                                        // Manejar el cambio en el select de estado
                                        statusSelect.addEventListener("change", function() {
                                            if (statusSelect.value === "cancelled") {
                                                cancellationReason.style.display = "block";
                                            } else {
                                                cancellationReason.value = ""; // Limpiar el contenido del campo
                                                cancellationReason.style.display = "none";
                                            }
                                        });
                                    });
                                </script>
                            @endpush
                        @endif
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="turn_type_id" class="form-control-label">Categoría de turno</label>
                                <select name="turn_type_id" id="turn_type_id" class="form-control">
                                    @foreach ($categories as $categoryId => $categoryName)
                                        <option value="{{ $categoryId }}"
                                            {{ old('turn_type_id', isset($data) && $data->turn_type_id == $categoryId ? 'selected' : '') }}>
                                            {{ $categoryName }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('turn_type_id')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="module_id" class="form-control-label">Módulo</label>
                                <select name="module_id" id="module_id" class="form-control">
                                    @foreach ($modules as $moduleId => $moduleName)
                                        <option value="{{ $moduleId }}"
                                            {{ old('module_id', isset($data) && $data->module_id == $moduleId ? 'selected' : '') }}>
                                            {{ $moduleName }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('module_id')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="identification" class="form-control-label">Identificación</label>
                                <input class="form-control" type="text" id="identification" name="identification"
                                    value="{{ old('identification', $data->identification ?? '') }}"
                                    onfocus="focused(this)" onfocusout="defocused(this)">
                                @error('identification')
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
                                <label for="start_datetime" class="form-control-label">Fecha y hora de inicio</label>
                              
                                @if (isset($data))
                                    <input class="form-control" type="datetime-local" id="start_datetime"
                                        name="start_datetime"
                                        value="{{ old('start_datetime', $data->start_datetime ?? '') }}">
                                @else
                                    <input class="form-control" type="datetime-local" id="start_datetime"
                                        name="start_datetime"
                                        value="{{ old('start_datetime', $data->start_datetime ?? '') }}"
                                        min="{{ now()->format('Y-m-d\TH:i') }}">
                                @endif


                                @error('start_datetime')
                                    <p class="text-danger text-xs pt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>


                        {{--  <div class="col-md-6">
                            <div class="form-group">
                                <label for="end_datetime" class="form-control-label">Fecha y hora de finalización (Opcional)</label>
                                <input class="form-control" type="datetime-local" id="end_datetime" name="end_datetime"
                                    value="{{ old('end_datetime') }}">
                                @error('end_datetime')
                                    <p class="text-danger text-xs pt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div> --}}

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
