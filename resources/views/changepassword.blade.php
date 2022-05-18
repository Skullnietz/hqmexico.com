@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cambio de Contraseña') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @elseif (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('updatepassword')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="formGroupExampleInput">Contaseña Actual</label>
                            <input type="text" name="contraseña" class="form-control" id="formGroupExampleInput" placeholder="Contaseña Actual" @error('contraseña') is-invalid @enderror>
                            @error('contraseña')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div><br>
                        <div class="form-group">
                          <label for="formGroupExampleInput">Nueva Contraseña</label>
                          <input type="text" name="nueva_contraseña" class="form-control" id="formGroupExampleInput" placeholder="Nueva Contraseña">
                          @error('nueva_contraseña')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div><br>
                        <div class="form-group">
                          <label for="formGroupExampleInput2">Confirmar Nueva Contraseña</label>
                          <input type="text" name="nueva_contraseña_confirmation" class="form-control" id="formGroupExampleInput2" placeholder="Confirmar Nueva Contraseña">
                        </div>
                        <div><br>
                            <center><button class="btn btn-success"  type="submit"> Cambiar contraseña</button></center>
                        </div>

                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
