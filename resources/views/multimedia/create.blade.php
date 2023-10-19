@extends('layouts.app')

@section('content')

    @include('layouts.navbars.auth.topnav', ['title' => 'Multimedia'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 p-3">

                </div>

                <div class="card-body">
                    <p class="text-uppercase text-sm">Multimedia</p>
                    @if (isset($data))
                        <form method="POST" action="{{ route('multimedia.update', ['id' => $data->id]) }}"
                            enctype="multipart/form-data">
                        @else
                            <form method="POST" action="{{ route('multimedia.store') }}" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="url" class="form-control-label">Subir archivo</label>
                                <input type="file" class="form-control" name="url" id="url"
                                    accept=".jpg, .jpeg, .png, .gif, .mp4, .avi" onchange="validateFileSize()">
                                <span id="fileSizeError" class="text-danger" style="display: none;">El archivo es demasiado
                                    grande. El tamaño máximo permitido es 5MB.</span>
                                @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-icon btn-3 btn-sm btn-primary mb-0">
                                {{ isset($data) ? 'Actualizar' : 'Registrar' }}
                            </button>
                        </div>
                    </div>
                    </form>

        

                    @push('js')
                        <script>
                            function validateFileSize() {
                                Swal.fire({!! Session::pull('alert.config') !!});
                                var fileInput = document.getElementById('url');
                                var fileSize = fileInput.files[0].size; // Tamaño en bytes
                                var maxSize = 5 * 1024 * 1024; // 5 MB en bytes

                                var fileSizeError = document.getElementById('fileSizeError');
                                if (fileSize > maxSize) {
                                    fileSizeError.style.display = 'block';
                                    return false; // Detener el envío del formulario
                                } else {
                                    fileSizeError.style.display = 'none';
                                    return true; // Permitir el envío del formulario
                                }
                            }
                        </script>
                    @endpush

                </div>
            </div>
        </div>
    @endsection
