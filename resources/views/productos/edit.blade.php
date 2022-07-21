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

<!-- * Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><br>
                    <h1 class="m-0">Productos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item active">Usuarios</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- * Contenido -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @if(isset($alert))
                <div class="col-12">
                    {{ $alert }}
                </div>
            @endif
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            @if(isset($producto))
                                {{ $producto->title }}
                            @endif
                        </h5>
                        
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <style>
                        .buttons-area{
                            display: grid;
                            grid-template-columns: repeat(3, 1fr);
                            gap: 10px;
                        }
                        .product-container{
                            display: grid;
                            grid-template-columns: repeat(3, 1fr);
                            grid-template-rows: repeat(2, 1fr);
                            gap: 10px;
                            grid-template-areas: "img title sku"
                                                "img button button";
                        }
                        .product-image{
                            grid-area: img;
                        }
                        .product-image img{
                            heigth: 100px;
                        }
                        .product-title{
                            grid-area: title;
                        }
                        .prduct-title span{
                            color: #000C28;
                        }
                        .product-sku{
                            grid-area: sku;
                        }
                        .product-sku span{
                            color: #000C28;
                        }
                        .product-button{
                            grid-area: button;
                            text-align: center;
                        }
                    </style>
                    <div class="card-body">
                        <form action="../update/{{ $producto->id }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <img src="{{ asset('images/productos/'.str_replace(' ', '_', $producto->seccion).'/'.$categoria->nombre.'/'.$producto->img) }}" alt="">
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="input-container">
                                        <label for="title">Nombre</label>
                                        <input type="text" name="title" class="form-control" value="{{ $producto->title }}">
                                    </div>
                                    <div class="input-container">
                                        <label for="sku">SKU</label>
                                        <input type="text" name="sku" class="form-control" value="{{ $producto->sku }}">
                                    </div>
                                    <div class="input-container">
                                        <label for="marca">Marca</label>
                                        <input type="text" name="marca" class="form-control" value="{{ $producto->marca }}" placeholder="Marca">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                <div class="input-container">
                                        <label for="replace_num">Numero de remplazo</label>
                                        <input type="text" name="replace_num" class="form-control" value="{{ $producto->replace_num }}" placeholder="Numero de remplazo">
                                    </div>
                                    <div class="input-container">
                                        <label for="seccion">Seccion</label>
                                        <select name="seccion" id="seccion" class="form-control" autocomplete="off">
                                            <option value="" disabled>Selecciona una opcion</option>
                                            @foreach($secciones as $seccion)
                                                @if($seccion->nombre == $producto->seccion)
                                                    <option value="{{ $seccion->nombre }}" selected>{{ $seccion->nombre }}</option>
                                                @else
                                                    <option value="{{ $seccion->nombre }}">{{ $seccion->nombre }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-container">
                                        <label for="categoria">Categoria</label>
                                        <select name="categoria" id="categoria" class="form-control" autocomplete="off"></select>
                                    </div>
                                </div>
                                <div class="col-md-12 col sm-12">
                                    <center>
                                        <input type="submit" value="Guardar" class="btn btn-primary">
                                    </center>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    fetch('../getCategoriasByID/'+{{$producto->categoria}})
        .then((response)=>response.json())
        .then((response)=>{
            console.log(response);
            let categoriaContainer = document.querySelector('#categoria');
            response.forEach((element)=>{
                let option = element.id == {{$producto->categoria}} 
                                                ? `<option value="${element.id}" selected>${element.nombre}</option>`
                                                : `<option value="${element.id}">${element.nombre}</option>`;
                categoriaContainer.innerHTML = categoriaContainer.innerHTML + option;
            });
        })

    document.querySelector('#seccion').addEventListener('change', ()=>{
        fetchCategorias();
    });

    function fetchCategorias(){
        fetch('../getCategoriasByName/'+document.querySelector('#seccion').value)
            .then((response)=>response.json())
            .then((response)=>{
                let categoriaContainer = document.querySelector('#categoria');
                categoriaContainer.innerHTML = '';
                response.forEach((element)=>{
                    let option = element.id == {{$producto->categoria}} 
                                                ? `<option value="${element.id}" selected>${element.nombre}</option>`
                                                : `<option value="${element.id}">${element.nombre}</option>`;
                    categoriaContainer.innerHTML = categoriaContainer.innerHTML + option;
                });
            })
    }
</script>

@endsection