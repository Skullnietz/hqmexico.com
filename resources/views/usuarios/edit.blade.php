@extends('layouts.sidebarnavbar')
@section('UsuariosActive')
active
@endsection
@section('contenidoPrincipal')
<!-- ///////////////////// CONTENIDO HEADER /////////////////////////////// -->
 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><br>
          <h1 class="m-0">Editar usuario</h1>


        </div><!-- /.col -->

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/usuarios">Usuarios</a></li>
            <li class="breadcrumb-item active">Editar</li>
          </ol>
        </div><!-- /.col -->
      </div>
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Info boxes -->

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Formulario de edición de usuario</h5>



              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if(isset($mensaje))
                <div class="col-md-12">
                  {{$mensaje}}
                </div>
                @endif
                <form method="POST" action="{{ route('userupdate', ['id'=>$usuario[0]->id]) }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$usuario[0]->name}}" placeholderrequired autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo Electrónico ') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $usuario[0]->email }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <center>
                            <button type="submit" class="btn btn-lg btn-primary">
                                {{ __('Editar usuario') }}
                            </button>
                         </center>
                        </div>
                    </div>
                </form>
            </div>
            <!-- ./card-body -->
            <div class="card-footer">

              <!-- /.row -->
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
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
      <!-- /.row -->

      <!-- Main row -->

      <!-- /.row -->
    </div><!--/. container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection


