<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Seccion;

use Barryvdh\DomPDF\Facade as PDF;

use Mpdf\Mpdf;

class CatalogoController extends Controller
{

    public function index()
    {
        //return view('catalogo.catalogoupdate');

    }

    public function edit(){
        return view('catalogo.catalogoupdate');
    }

    public function update(Request $request){
        $user = Auth::user() == null ? false: true;
        if($user){
            try{
                \File::delete(public_path("images/catalogo.pdf"));
            }catch(Error $e){
                return $e;
            }
            
            \Storage::disk('local')->put('catalogo.pdf', \File::get($request->file('catalogo')));
            return redirect(back());
        }else{
            return redirect(route('login'));
        }
    }

    public function productos(){
        $secciones = \DB::table('categorias')->select('id', 'nombre')->get();
        $categorias = \DB::table('secciones')->get();
        $productos = \DB::table('productos')->select('id', 'title', 'sku', 'img', 'seccion', 'categoria')->get();

        return view('catalogo.productos')
            ->with('secciones', $secciones)
            ->with('categorias', $categorias)
            ->with('productos', $productos);
    }

    public function storecategorias(Request $request){


        $request->validate([
            'nombre' => 'required',
            'id_categoria' => 'required',
        ]);

        $categoria = new categoria();
        $categoria-> nombre = $request->nombre;
        $categoria-> id_categoria = $request->id_categoria;
        $direccion = strtr("$request->nombre", " ", "_");
        $seccionuno = Seccion::where('id',$request->id_categoria)->select('nombre')->first();
         $direccionuno = strtr($seccionuno->nombre, " ", "_");
         $path = public_path("images/productos/$direccionuno/$direccion");
     if(!File::isDirectory($path)){
         File::makeDirectory($path, 0777, true, true);
         $categoria->save();
         return redirect('/catalogo/categorias')->with('crear', 'ok');


     }else{
         return redirect('/catalogo/categorias')->with('crear', 'no');
     }
    }

    public function storesecciones(Request $request){

        $request->validate([
            'nombre' => 'required'
        ]);

        $seccion = new seccion();
        $seccion-> nombre = $request->nombre;
        $direccion = strtr("$request->nombre", " ", "_");
        $path = public_path("images/productos/$direccion");
    if(!File::isDirectory($path)){
        File::makeDirectory($path, 0777, true, true);
        $seccion->save();
        return redirect('/catalogo/secciones')->with('crear', 'ok');


    }else{
        return redirect('/catalogo/secciones')->with('crear', 'no');
    }

    }

    public function deletesecciones(Seccion $seccion){

        $seccion = Seccion::where('id', $seccion->id)->get()->first();
        $direccion = strtr("$seccion->nombre", " ", "_");
        $path = public_path("images/productos/$direccion");
        File::deleteDirectory($path);
        $seccion->delete();
        return redirect('/catalogo/secciones')->with('eliminar', 'ok');
    }


    public function deletecategorias(Categoria $Categoria){
        $Categoria = Categoria::where('id', $Categoria->id)->get()->first();
        $direccion = strtr("$Categoria->nombre", " ", "_");
        $seccionuno = Seccion::where('id',$Categoria->id_categoria)->select('nombre')->first();
        $direccionuno = strtr($seccionuno->nombre, " ", "_");
        $path = public_path("images/productos/$direccionuno/$direccion");
        File::deleteDirectory($path);
        $Categoria->delete();
        return redirect('/catalogo/categorias')->with('eliminar', 'ok');
    }

    public function updatecategoria(Request $request){
        $Categoria = Categoria::where('id',$request->id)->first();
        $Categoria->id_categoria = $request->id_categoria;
        $direccion = strtr("$Categoria->nombre", " ", "_");
        $Categoria->nombre = $request->nombre;
        $seccion = Seccion::where('id',$Categoria->id_categoria)->select('nombre')->first();
        $direccionuno = strtr("$request->nombre", " ", "_");
        $direcciondos = strtr("$seccion->nombre", " ", "_");
        //return $direccionuno;
        rename("images/productos/".$direcciondos."/".$direccion."/", "images/productos/".$direcciondos."/".$direccionuno."/");
        $Categoria->save();

        return redirect('/catalogo/categorias')->with('actualizar', 'ok');
    }

    public function updateseccion(Request $request){
        $seccion = Seccion::find($request->id);
        $direccion = strtr("$seccion->nombre", " ", "_");
        $seccion->nombre = $request->nombre;
        $direccionuno = strtr("$request->nombre", " ", "_");
        rename("images/productos/".$direccion,"images/productos/".$direccionuno);
        $seccion->save();
        return redirect('/catalogo/secciones')->with('actualizar', 'ok');
    }



    public function categorias()
    {
        $user = Auth::user() == null ? false: true;
        if($user){
            $secciones = \DB::table('categorias')->get();
            $categorias = \DB::table('secciones')->get();
            $data = array();
            foreach($categorias as $c){
            $seccion = \DB::table('categorias')->where('id',$c->id_categoria)->get();
            $c->seccion = $seccion;
            array_push($data, $c);
            }
            return view('catalogo.categorias')->with('categorias',$data)->with('secciones',$secciones);

        }else{
            return redirect(route('login'));
        }
    }

    public function secciones()
    {
        $secciones = \DB::table('categorias')->get();
        return view('catalogo.secciones')->with('secciones', $secciones);
    }

    public function catalogoExport(){
        $productos = [];
        while($count<count($productos)){
            $page = [];
            $countNum = 0;
            for($i = ($pageNum*6)-6; $i<$pageNum*6; $i++){
                if(!isset($productos[$i])){break;}
                array_push($page, $productos[$i]);
                $count++;
            }
            $pageNum++;
            array_push($pages, $page);
        }
        
        return $pages;
    }

    public function exportCatalogo(Request $request){
        
        $productos = json_decode($request->productos);

        //return $this->createPages($productos);
        
        //return $pages;
        $pdf = PDF::loadView('catalogo.index', ['pages'=>$this->createPages($productos)])
            ->setPaper('letter', 'landscape');
        return $pdf->download('CatalogoHQMex.pdf'); 
    }

    function createPages($productos){

        $count = 0;
        $pages = [];
        $pageNum = 1;
        $checkNum = 1;
        $page = [];
        $productosP = [];

        while($count<count($productos)){
            $i = ($pageNum*6)-6;
            $val = intval($pageNum*6) > intval(count($productos)) ? count($productos) : ($pageNum*6);
            for($i; $i<$val; $i++){
                
                array_push($productosP, $productos[$i]);
                $count++;
            }
            $categoria = $productosP[0]->categoria;
            array_push($page, [$productosP, $categoria]);

            $pageNum++;
            array_push($pages, $page[0]);
            $page = [];
            $productosP = [];
        }

        return $pages;
    }
}
