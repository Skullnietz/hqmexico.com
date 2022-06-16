@extends('layouts.sidebarnavbar')
@section('NewsletterActive')
    active
@endsection
@section('contenidoPrincipal')
    <!-- ///////////////////// CONTENIDO HEADER /////////////////////////////// -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><br>
                    <h1 class="m-0">Newsletter</h1>


                </div><!-- /.col -->

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item active">Newsletter</li>
                    </ol>
                </div><!-- /.col -->
            </div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalAgregar">
                Agregar usuario
              </button>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Modal -->
<div class="modal fade" id="ModalAgregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar usuario a Newsletter</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('newsletterstore')}}" method="POST">
                @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre</label>
                <input name="nombre" type="text" class="form-control" id="exampleInputEmail1"  placeholder="Nombre">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Correo Electrónico</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Correo Electronico">
                <small id="emailHelp" class="form-text text-muted"></small>
              </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit"  class="btn btn-primary">Agregar</button>
        </div></form>
      </div>
    </div>
  </div>
            <!-- Info boxes -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Lista de Usuarios Registrados</h5>



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
                            <form class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" id="search-input" type="search"
                                    placeholder="Buscar usuario" aria-label="Search">
                                <button class="btn btn-outline-success my-2 my-sm-0" id="search-button"
                                    type="submit">Buscar</button>
                            </form><br>
                            <div style="overflow-x:auto;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Correo</th>
                                            <th scope="col">Enviar Correo</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">
                                        @foreach ($usuarios as $usuario)
                                            <tr>
                                                <td>{{ $usuario->id }}</td>
                                                <td>{{ $usuario->nombre }}</td>
                                                <td>{{ $usuario->email }}</td>

                                                <td><a class="btn btn-primary" href="mailto:{{ $usuario->email }}"><i
                                                            class="fas fa-envelope"></i></a></td>
                                                <td><button class="btn-sm btn-warning" data-toggle="modal" data-target="#ModalEditar{{ $usuario->id }}"><i class="fas fa-edit"></i>
                                                        Editar</button><a style="color:white" href="/newsletterdelete/{{ $usuario->id }}"><button class="btn-sm btn-danger"><i
                                                            class="fas fa-trash"></i> Eliminar</a></button></td>
                                            </tr>
                                            <!-- Modal -->
<div class="modal fade" id="ModalEditar{{ $usuario->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar usuario a Newsletter</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="/newsletterupdate/{{ $usuario->id }}" method="PUT">
                @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre</label>
                <input name="nombre" value="{{ $usuario->nombre }}" type="text" class="form-control" id="exampleInputEmail1"  placeholder="Nombre">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Correo Electrónico</label>
                <input name="email" value="{{ $usuario->email }}"type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Correo Electronico">
                <small id="emailHelp" class="form-text text-muted"></small>
              </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit"  class="btn btn-primary">Editar</button>
        </div></form>
      </div>
    </div>
  </div>
                                        @endforeach

                                    </tbody>
                                </table>

                            </div>

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
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Liga de envio correo</h5>



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

                            <div style="overflow-x:auto;">
                                <div class="container">
                                    <div class="row">


                                        <a href="mailto:@foreach ($usuarios as $usuario){{ $usuario->email }},@endforeach"
                                            class="btn-lg btn-success"><i class="fas fa-at"></i> Liga de Correos
                                        </a>
                                    </div>
                                    <hr>
                                    <div class="row">


                                        <div class="col">
                                            @foreach ($usuarios as $usuario){{ $usuario->email }};@endforeach
                                        </div>

                                    </div>
                                    <br>

                                </div>

                            </div>

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
            <!-- /.row -->

            <!-- Main row -->

            <!-- /.row -->
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
