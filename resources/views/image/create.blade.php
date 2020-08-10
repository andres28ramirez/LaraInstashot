@extends ('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if(session('status'))
                <h3 class="text-center alert alert-success">{{ session('status') }}</h3>
            @endif

            <div class="card">
                <div class="card-header">
                    Subir Nueva Imagen
                </div>
              
                <div class="card-body">
                    <form method="post" action="{{ route('image-save') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="image_path" class="col-md-3 col-form-label text-md-right">Imagen</label>
                            <div class="col-md-6">
                                <input type="file" id="image_path" name="image_path" class="form-control" required>
                                @if($errors->has('image_path'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image_path') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-3 col-form-label text-md-right">Descripción</label>
                            <div class="col-md-6">
                                <textarea id="description" name="description" class="form-control" required></textarea>
                                <!-- MANEJAMOS LOS ERRORES -->
                                @if($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <input type="submit" class="btn btn-primary" value="Subir Imagen">
                            </div>
                        </div>

                    </form>
                </div>

            </div> 

        </div>
    </div>
</div>

@endsection