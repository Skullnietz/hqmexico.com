@extends('layouts.sidebarnavbar')
@section('CatalogoActive')
active
@endsection
@section('CatalogoMenuActive')
menu-open
@endsection
@section('CategoriasCatalogoActive')
active
@endsection
@section('contenidoPrincipal')
<!-- ///////////////////// CONTENIDO HEADER /////////////////////////////// -->
 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><br>
          <h1 class="m-0">Categorias</h1>


        </div><!-- /.col -->

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Catalogo</a></li>
            <li class="breadcrumb-item active">Categorias</li>
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
              <h5 class="card-title">Agregar categoria</h5>
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
                <form action="{{url('/storecategorias')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Seccion</label>
                        <select name="id_categoria" class="form-control" id="exampleFormControlSelect1">
                          @foreach ($secciones as $seccion)
                          <option  value="{{$seccion->id}}">{{$seccion->nombre}} </option>
                          @endforeach
                        </select>
                    </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nombre de categoria</label>
                            <input spellcheck type="text" name="nombre" class="form-control" id="exampleFormControlInput1" placeholder="Nombre de la categoria">
                          </div>
                         <center> <button type="submit" class="btn btn-primary"> Agregar Categoria </button> </center>

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
      <!-- /.row -->

      <!-- Main row -->

      <!-- /.row -->
    </div><!--/. container-fluid -->
    <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Lista de categorias</h5>



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
                    <table class="table">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Seccion</th>
                              <th scope="col">Nombre de la categoria</th>
                              <th scope="col">Acciones</th>
                            </tr>
                          </thead>
                          <tbody id="table-body">
                              @foreach ($categorias as $categoria)
                              <tr>
                                  <td> {{$categoria->id}} </td>
                                  <td> {{$categoria->seccion[0]->nombre}} </td>
                                  <td> {{$categoria->nombre}} </td>
                                  <td>  <a  class="btn-sm btn-warning" href="/categoria/editar/{{$categoria->id}}">Editar</a>
                                    <form action="/deletecategorias/{{$categoria->id}}" class="fomulario-eliminar">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn-xs btn-danger ">Eliminar</button>
                                        </form></td>
                              </tr>
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
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>
@if(session('eliminar') == 'ok')
<script>
  Swal.fire(
          '¡Borrado!',
          'El registro ha sido borrado.',
          'success'

      )
</script>
@endif
<script>
$('.fomulario-eliminar').submit(function(e){
 e.preventDefault();
 Swal.fire({
     title: '¿Estas seguro?',
     text: "Este registro sera borrado",
     icon: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#3085d6',
     cancelButtonColor: '#d33',
     confirmButtonText: 'Si, borralo.'
 }).then((result) => {
     if(result.value){

    this.submit();
    }
 })
});



</script>
@endsection
