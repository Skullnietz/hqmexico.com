@extends('layouts.sidebarnavbar')
@section('CatalogoActive')
active
@endsection
@section('CatalogoMenuActive')
menu-open
@endsection
@section('ProductosCatalogoActive')
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
              <h5 class="card-title">Carpeta de productos</h5>



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
                <p>
                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                      Link with href
                    </a>
                  </p>
                  <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                      Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
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
          let tableRow = document.createElement('tr');
          tableRow.setAttribute('id', `tr-${element.id}`);
          let id = `<th scope="row">${element.id}</th>`;
          let seccion = `<td>${element.seccion}</td>`;
          let categoria = `<td>${element.categoria}</td>`;
          let title = `<td>${element.title}</td>`;
          let sku = `<td>${element.sku}</td>`;
          let img = `<td><img class="img-thumbnail" width="100px" src="${element.img}"></td>`;
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
