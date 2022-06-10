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

class CatalogoController extends Controller
{

    public function index()
    {
        $secciones= Seccion::all();

    }

    public function productos(){
        return view('catalogo.productos');
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
}
