@extends('layouts.sidebarnavbar')
@section('UsuariosActive')
active
@endsection
@section('contenidoPrincipal')
<style>
    .drag-area{
  border: 2px dashed #fff;
  height: 300px;
  width: 300px;
  border-radius: 5px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}
.drop{
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  background: #5256ad;
}
.drag-area.active{
  border: 2px solid #fff;
}
.drag-area .icon{
  font-size: 50px;
  color: #fff;
}
.drag-area header{
  font-size: 20px;
  font-weight: 200;
  color: #fff;
}
.drag-area span{
  font-size: 15px;
  font-weight: 200;
  color: #fff;
  margin: 10px 0 15px 0;
}
.drag-area button{
  padding: 10px 25px;
  font-size: 20px;
  font-weight: 500;
  border: none;
  outline: none;
  background: #fff;
  color: #0e96d4;
  border-radius: 5px;
  cursor: pointer;
}
.drag-area img{
  height: 100%;
  width: 100%;
  object-fit: cover;
  border-radius: 5px;
}
</style>
<!-- ///////////////////// CONTENIDO HEADER /////////////////////////////// -->
 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><br>
          <h1 class="m-0">Crear producto</h1>


        </div><!-- /.col -->

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/productos/indexview">Productos</a></li>
            <li class="breadcrumb-item active">Crear</li>
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
              <h5 class="card-title">Formulario de creación de productos</h5>



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
              <form method="POST" action="{{ route('productosstore') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col ">
                    <div class="row mb-1">
                        <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-1">
                        <label for="sku" class="col-md-4 col-form-label text-md-end">{{ __('SKU ') }}</label>

                        <div class="col-md-6">
                            <input id="sku" type="sku" class="form-control @error('sku') is-invalid @enderror" name="sku" value="{{ old('sku') }}" required autocomplete="sku">

                            @error('sku')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-1">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Replace Num') }}</label>

                        <div class="col-md-6">
                            <input id="replace_num" type="text" class="form-control @error('replace_num') is-invalid @enderror" name="replace_num" required autocomplete="replace_num">

                            @error('replace_num')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-1">
                            <label class="col-md-4 col-form-label text-md-end" for="seccion">Seccion</label>

                            <div class="col-md-6">
                            <select class="form-control" name="seccion" id="secciones-select">
                              @foreach($secciones as $seccion)
                                <option value="{{$seccion->id}}">{{$seccion->nombre}}</option>
                              @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="row mb-1">
                        <label class="col-md-4 col-form-label text-md-end" for="categoria">Categoria</label>

                        <div class="col-md-6">
                        <select class="form-control" name="categoria" id="categorias-select">
                          
                        </select>
                    </div>
                </div><br>
            </div>

            <div class="col ">
              <div class="drag-area" style="background-color:rgb(13, 131, 228);">
                <div class="icon"><i class="fas fa-cloud-upload-alt"></i></div>
                <header>Drag & Drop to Upload File</header>
                <span>OR</span>
                <button>Browse File</button>
                <input name="img" type="file" hidden>
              </div>
            </div>
          </div>

                </div>
                    <input name="activo" type="hidden" >

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <center>
                            <button type="submit" class="btn btn-lg btn-primary">
                                {{ __('Crear Producto') }}
                            </button>
                         </center><br>
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
      <!-- /.row -->

      <!-- Main row -->

      <!-- /.row -->
    </div><!--/. container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- Categorias segun su seccion -->
<script>

  loadCategoriasOptions();
  
  document.querySelector('#secciones-select').addEventListener('change', (e)=>{
    loadCategoriasOptions();
  });

  function loadCategoriasOptions(){
    fetch("{{route('productosgetcategorias')}}")
      .then((response)=>response.json())
      .then((response)=>{
        let categorias_select = document.querySelector('#categorias-select');
        categorias_select.innerHTML = '';
        response.forEach((element)=>{
          if(element.id_seccion == document.querySelector('#secciones-select').value){
            let option = document.createElement('option');
            option.value = element.id;
            option.innerHTML = element.nombre;
            categorias_select.appendChild(option);
          }
        });
      });
  }
</script>

<!-- /.content-wrapper -->
<script>
    //selecting all required elements
const dropArea = document.querySelector(".drag-area"),
dragText = dropArea.querySelector("header"),
button = dropArea.querySelector("button"),
input = dropArea.querySelector("input"),
span = dropArea.querySelector('span'),
icon = dropArea.querySelector('.icon');
let file; //this is a global variable and we'll use it inside multiple functions
button.onclick = (e)=>{
  e.preventDefault();
  input.click(); //if user click on the button then the input also clicked
}
input.addEventListener("change", function(e){
  //getting user select file and [0] this means if user select multiple files then we'll select only the first one
  file = this.files[0];
  
  dropArea.classList.add("active");
  showFile(); //calling function
});
//If user Drag File Over DropArea
dropArea.addEventListener("dragover", (event)=>{
  event.preventDefault(); //preventing from default behaviour
  dropArea.classList.add("active");
  dragText.textContent = "Release to Upload File";
});
//If user leave dragged File from DropArea
dropArea.addEventListener("dragleave", (event)=>{
  event.preventDefault();
  dropArea.classList.remove("active");
  dragText.textContent = "Drag & Drop to Upload File";
});
//If user drop File on DropArea
dropArea.addEventListener("drop", (event)=>{
  event.preventDefault(); //preventing from default behaviour
  //getting user select file and [0] this means if user select multiple files then we'll select only the first one
  file = event.dataTransfer.files[0];
  showFile(); //calling function
});
function showFile(){
  let fileType = file.type; //getting selected file type
  let validExtensions = [ "image/png"]; //adding some valid image extensions in array
  if(validExtensions.includes(fileType)){ //if user selected file is an image file
    let fileReader = new FileReader(); //creating new FileReader object
    fileReader.onload = ()=>{
      let fileURL = fileReader.result; //passing user file source in fileURL variable
        // UNCOMMENT THIS BELOW LINE. I GOT AN ERROR WHILE UPLOADING THIS POST SO I COMMENTED IT
      //let imgTag = `<img src="${fileURL}" alt="image">`; //creating an img tag and passing user selected file source inside src attribute
      let imgTag = document.createElement('img');
      imgTag.setAttribute('src', fileURL);
      dropArea.removeChild(dragText);
      dropArea.removeChild(button);
      dropArea.removeChild(icon);
      dropArea.removeChild(span);
      dropArea.appendChild(imgTag);
    }
    fileReader.readAsDataURL(file);
  }else{
    alert("Esto no es un .png");
    dropArea.classList.remove("active");
    dragText.textContent = "Drag & Drop to Upload File";
  }
}
</script>
@endsection
