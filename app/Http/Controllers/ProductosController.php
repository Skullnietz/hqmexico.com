<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductosController extends Controller
{
    public function index(){
        $user = Auth::user() == null ? false: true;
        if($user){
            $productos = \DB::table('productos')->select('id', 'title', 'sku', 'img', 'replace_num','seccion','categoria')->where('activo', 1)->get();
            return json_encode(array(['data' => $productos]));
        }else{
            return redirect(route('login'));
        }
    }

    public function Productoslist(){
        $user = Auth::user() == null ? false: true;
        if($user){
            return  view('productos.index');

        }else{
            return redirect(route('login'));
        }
    }

    public function search($input){
        $user = Auth::user() == null ? false: true;
        if($user){
            $productos = \DB::table('productos')
                ->where('title', 'like', '%'.$input.'%')
                ->select('id', 'title', 'sku', 'img', 'replace_num','seccion','categoria')
                ->get();
            return json_encode(array(['data' => $productos]));
        }else{
            return redirect(route('login'));
        }
    }

    public function show($id){
        $user = Auth::user() == null ? false: true;
        if($user){
            return \DB::table('productos')->where('id', $id)->get();
        }else{
            return redirect(route('login'));
        }
    }
    public function create(){
        $user = Auth::user() == null ? false: true;
        if($user){
            return view('productos.create');
        }else{
            return redirect(route('login'));
        }
    }
    public function store(Request $request){
        $user = Auth::user() == null ? false: true;
        if($user){
            $producto = \DB::table('productos')->insert([
                'title' => $request->title,
                'sku' => $request->sku,
                'replace_num' => $request->replace->num,
                'servicio' => $request->servicio == null ? 0 : $request->servicio,
                'activo' => $request->activo == null ? 1 : $request->activo,
                'img' => $request->img,
                'page' => $request->page,
                'fila' => $request->fila,
                'seccion' => $request->seccion,
                'categoria' => $request->categoria,
                'orden_interno' => $request->orden_interno,
            ]);
            return 'Registro realizado';
        }else{
            return redirect(route('login'));
        }
    }

    public function update(Request $request, $id){
        $user = Auth::user() == null ? false: true;
        if($user){
            $producto = \DB::table('productos')->where('id', $id)
                ->update([
                    'title' => $request->title,
                    'sku' => $request->sku,
                    'replace_num' => $request->replace->num,
                    'servicio' => $request->servicio == null ? 0 : $request->servicio,
                    'activo' => $request->activo == null ? 1 : $request->activo,
                    'img' => $request->img,
                    'page' => $request->page,
                    'fila' => $request->fila,
                    'seccion' => $request->seccion,
                    'categoria' => $request->categoria,
                    'orden_interno' => $request->orden_interno,
                ]);
            return 'Registro actualizado';
        }else{
            return redirect(route('login'));
        }
    }

    public function delete($id){
        $user = Auth::user() == null ? false: true;
        if($user){
            $producto = \DB::table('productos')->where('id', $id)
                ->delete();
            return array(['deleted' => true]);
        }else{
            return redirect(route('login'));
        }
    }
}
