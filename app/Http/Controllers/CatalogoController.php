<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Seccion;

class CatalogoController extends Controller
{
    public function index()
    {
        $user = Auth::user() == null ? false: true;
        if($user){
            $secciones = \DB::table('categorias')->get();
                return view('catalogo.index')->with('secciones', $secciones);
        }else{
            return redirect(route('login'));
        }

    }

    public function storecategorias(Request $request){

        $request->validate([
            'nombre' => 'required',
            'id_categoria' => 'required',
        ]);

        $categoria = new categoria();
        $categoria-> nombre = $request->nombre;
        $categoria-> id_categoria = $request->id_categoria;
        $categoria->save();
        return redirect('/catalogo/categorias');
    }

    public function storesecciones(Request $request){

        $request->validate([
            'nombre' => 'required'
        ]);

        $seccion = new seccion();
        $seccion-> nombre = $request->nombre;
        $seccion->save();
        return redirect('/catalogo/secciones');
    }

    public function deletesecciones(Seccion $seccion){

        $seccion = Seccion::where('id', $seccion->id)->get()->first();
        $seccion->delete();
        return redirect('/catalogo/secciones')->with('eliminar', 'ok');
    }

    public function deletecategorias(Categoria $Categoria){
        $Categoria = Categoria::where('id', $Categoria->id)->get()->first();
        $Categoria->delete();
        return redirect('/catalogo/categorias')->with('eliminar', 'ok');
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
