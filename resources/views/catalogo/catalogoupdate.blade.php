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
                    <h1 class="m-0">Catalogo</h1>
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
                            Actualizar catalogo
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
                        <form action="{{ route('catalogoupdate') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                
                                <div class="col-md-4 col-sm-12" style="text-align: right;">
                                    <label for="catalogo">Catalogo</label>
                                </div>
                                <div class="col-md-8 col-sm-12">
                                    <input type="file" name="catalogo" id="" required>
                                </div>
                                <div class="col-12">
                                    <center>
                                        <input type="submit" value="Actualizar" class="btn btn-primary">
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
@endsection