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
          <h1 class="m-0">Usuarios</h1>


        </div><!-- /.col -->

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Usuarios</li>
          </ol>
        </div><!-- /.col -->
      </div>
      <a style="" class="btn btn-sm btn-success" href="/usuario-crear"><i class="fas fa-user-plus"></i> Agregar Usuario</a><!-- /.row -->
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
              <h5 class="card-title">Lista de usaurios</h5>



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
                              <th scope="col">Nombre</th>
                              <th scope="col">Email</th>
                              <th scope="col">Acceso</th>
                              <th scope="col">Acciones</th>
                            </tr>
                          </thead>
                          <tbody id="table-body">
                              
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

      <!-- Main row -->

      <!-- /.row -->
    </div><!--/. container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
  const userIndexTable = ()=>{
    let tableBody = document.querySelector('#table-body');
    fetch("{{ route('userindex') }}")
      .then((response)=>response.json())
      .then((info)=>{
        let data = info[0].data;
        console.table(data);
        data.forEach((element)=>{
          let tableRow = document.createElement('tr');
          tableRow.setAttribute('id', `tr-${element.id}`);
          let id = `<th scope="row">${element.id}</th>`;
          let nombre = `<td>${element.name}</td>`;
          let email = `<td>${element.email}</td>`;
          let accesoButton = element.activo == 1 ? 
                `<td><a id="access-button-${element.id}" class="btn btn-xs btn-danger" href=""><i class="fas fa-door-closed"></i></i> Denegar </a></td>` :
                `<td><a id="access-button-${element.id}" class="btn btn-xs btn-success" href=""><i class="fas fa-door-open"></i> Aceptar </a></td>`;
          let actionsButton = `<td><a id="editar-button-${element.id}" class="btn btn-xs btn-primary" href=""><i class="fas fa-user-edit"></i> Editar </a>
                               <a id="eliminar-button-${element.id}" class="btn btn-xs btn-warning" href=""><i class="fas fa-user-times"></i> Borrar </a></td>`;
          tableRow.innerHTML= id+nombre+email+accesoButton+actionsButton;
          tableBody.appendChild(tableRow);


          document.querySelector(`#access-button-${element.id}`).addEventListener('click', (event)=>{
            event.preventDefault();
            fetch(`../usersetactivo/${element.id}`)
              .then((response)=>response.json())
              .then(response=>{
                if(response[0].activo == 'eliminado'){
                  document.querySelector(`#access-button-${element.id}`).className = 'btn btn-xs btn-success';
                  document.querySelector(`#access-button-${element.id}`).innerHTML = '<i class="fas fa-door-open"></i> Aceptar';
                }else{
                  document.querySelector(`#access-button-${element.id}`).className = 'btn btn-xs btn-danger';
                  document.querySelector(`#access-button-${element.id}`).innerHTML = '<i class="fas fa-door-closed"></i></i> Denegar';
                }
              });
          });

          <!-- ! Faltan el boton de editar -->
          document.querySelector(`#editar-button-${element.id}`).addEventListener('click', (event)=>{
            event.preventDefault();
            console.log('Boton de editar');
          });
          document.querySelector(`#eliminar-button-${element.id}`).addEventListener('click', (event)=>{
            event.preventDefault();
            fetch(`../userdelete/${element.id}`)
              .then((response)=>response.json())
              .then((response)=>{
                if(response[0].deleted == true){
                  document.querySelector('#table-body').removeChild(document.querySelector(`#tr-${element.id}`));
                }
              })
          });

        });
      }); 
  }
  userIndexTable();
</script>
@endsection
