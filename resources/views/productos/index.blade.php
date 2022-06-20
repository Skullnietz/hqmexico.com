@extends('layouts.sidebarnavbar')
@section('ProductosActive')
active
@endsection
@section('contenidoPrincipal')
<!-- ///////////////////// CONTENIDO HEADER /////////////////////////////// -->
 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><br>
          <h1 class="m-0">Productos</h1>


        </div><!-- /.col -->

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Usuarios</li>
          </ol>
        </div><!-- /.col -->
      </div>
      <a style="" class="btn btn-sm btn-success" href="/productos/create"><i class="fas fa-plus-circle"></i> Agregar Producto</a><!-- /.row -->
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
              <h5 class="card-title">Lista de productos</h5>



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
                    <input class="form-control mr-sm-2" id="search-input" type="search" placeholder="Buscar producto" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" id="search-button" type="submit">Buscar</button>
                  </form><br>
                <div style="overflow-x:auto;">
                    <table class="table">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Seccion</th>
                              <th scope="col">Categoria</th>
                              <th scope="col">Nombre</th>
                              <th scope="col">Sku</th>
                              <th scope="col">Imagen</th>
                              <th scope="col">Replace Num</th>
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
  const productIndexTable = (search_path)=>{
    let tableBody = document.querySelector('#table-body');
    fetch(search_path)
      .then((response)=>response.json())
      .then((info)=>{
        let data = info[0].data;
        tableBody.innerHTML = "";
        data.forEach((element)=>{
          let seccionesArray = element.seccion[0];
          let secciones = seccionesArray.nombre;
          let categoriasArray = element.categoria[0];
          let categorias = categoriasArray.nombre;
          let tableRow = document.createElement('tr');
          tableRow.setAttribute('id', `tr-${element.id}`);
          let id = `<th scope="row">${element.id}</th>`;
          let seccion = `<td>${secciones}</td>`;
          let categoria = `<td>${categorias}</td>`;
          let title = `<td>${element.title}</td>`;
          let sku = `<td>${element.sku}</td>`;
          let img = `<td><img class="img-thumbnail" width="100px" src="/images/productos/${secciones}/${categorias}/${element.img}"></td>`;
          let replace_num = element.replace_num == null ? `<td></td>`: `<td>${element.replace_num}</td>`;
          let actionsButton = `<td><a id="editar-button-${element.id}" class="btn btn-xs btn-primary" href="../productos/show/${element.id}"><i class="fas fa-edit"></i> Editar </a>
                               <a id="eliminar-button-${element.id}" class="btn btn-xs btn-warning" href=""><i class="fas fa-minus-circle"></i> Borrar </a></td>`;
          tableRow.innerHTML= id+seccion+categoria+title+sku+img+replace_num+actionsButton;
          tableBody.appendChild(tableRow);

          document.querySelector(`#eliminar-button-${element.id}`).addEventListener('click', (event)=>{
            event.preventDefault();
            fetch(`../productos/delete/${element.id}`)
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
  const search = ()=>{
    let searchInput = document.querySelector('#search-input');
    let searchButton = document.querySelector('#search-button');
    searchButton.addEventListener('click', (e)=>{
      e.preventDefault();
      let search_path = searchInput.value != "" ? `../productos/search/${searchInput.value}`: "{{ route('productosindex') }}";
      productIndexTable(search_path);
    });
  };
  productIndexTable("{{ route('productosindex') }}");
  search();
</script>
@endsection
