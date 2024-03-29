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
            $data = array();
            foreach($productos as $p){
            $categoria = \DB::table('secciones')->where('id',$p->categoria)->get();
            $seccion = \DB::table('categorias')->where('id',$p->seccion)->get();
            $p->seccion = $seccion;
            $p->categoria = $categoria;
            array_push($data, $p);
            }
            return json_encode(array(['data' => $data]));
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
                ->orWhere('sku', 'like', '%'.$input.'%')
                ->orWhere('replace_num', 'like', '%'.$input.'%')
                ->orWhere('seccion', 'like', '%'.$input.'%')
                ->orWhere('categoria', 'like', '%'.$input.'%')
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
            $producto = (\DB::table('productos')->where('id', $id)->get())[0];
            $categoria = (\DB::table('secciones')->select('nombre', 'id')->where('id', $producto->categoria)->get())[0];

            $secciones = \DB::table('categorias')->select('nombre', 'id')->get();

            return view('productos.edit')
                ->with('producto', $producto)
                ->with('categoria', $categoria)
                ->with('secciones', $secciones);
        }else{
            return redirect(route('login'));
        }
    }

    public function getCategoriasByID($id){
        $user = Auth::user() == null ? false: true;
        if($user){
            $categoria = (\DB::table('secciones')
                ->select(\DB::raw('id, nombre, id_categoria as id_seccion'))
                ->where('id', $id)
                ->get())[0];
            $secciones = (\DB::table('categorias')->where('id', $categoria->id_seccion)->get())[0];
            $categorias = \DB::table('secciones')->where('id_categoria', $secciones->id)->get();
            return $categorias;
        }else{
            return redirect(route('login'));
        }
    }

    public function getCategoriasByName($nombre){
        $user = Auth::user() == null ? false: true;
        if($user){
            $secciones = (\DB::table('categorias')->where('nombre', $nombre)->get())[0];
            $categorias = \DB::table('secciones')->where('id_categoria', $secciones->id)->get();
            return $categorias;
        }else{
            return redirect(route('login'));
        }
    }

    public function create(){
        $user = Auth::user() == null ? false: true;
        if($user){
            //$categorias = \DB::table('secciones')->select('id', 'nombre')->get();
            $secciones = \DB::table('categorias')->select('id', 'nombre')->get();
            return view('productos.create')
                //->with('categorias', $categorias)
                ->with('secciones', $secciones);
        }else{
            return redirect(route('login'));
        }
    }

    public function getCategorias(){
        $categorias = \DB::table('secciones')->select(\DB::raw('id, nombre, id_categoria as id_seccion'))->get();
        return response($categorias, 200)
            ->header('Content-Type', 'application/json');
    }

    public function store(Request $request){

        $user = Auth::user() == null ? false: true;
        if($user){

            $img_storage_path = "";
            if($request->file('img') != ""){
                $file = $request->file('img');
                $sections = (\DB::table('secciones')->select('nombre', 'id_categoria')->where('id', $request->seccion)->get())[0];
                $seccion_list = \DB::table('secciones')->select('nombre')->where('id_categoria', $sections->id_categoria)->get();
                $countable_sections = [];
                foreach($seccion_list as $section){
                    array_push($countable_sections, $section->nombre);
                }
                $clave = array_search($sections->nombre, $countable_sections);
                $categoria = (\DB::Table('categorias')->select('nombre')->where('id', $sections->id_categoria)->get())[0];

                $img_storage_path = "productos/".str_replace(" ","_",$categoria->nombre)."/".str_replace(" ", "_", $sections->nombre)."/".$file->getClientOriginalName();
                //return $img_storage_path;
            }

            $producto = \DB::table('productos')->insert([
                'title' => $request->title,
                'sku' => $request->sku,
                'replace_num' => $request->replace_num,
                'servicio' => $request->servicio == null ? 0 : $request->servicio,
                'activo' => $request->activo == null ? 1 : $request->activo,
                'orden_interno' => 0,
                'img' => $img_storage_path,
                'seccion' => $request->seccion,
                'categoria' => $request->categoria,
                'marca' => ''
            ]);



            if($request->file('img') != ''){
                $file = $request->file('img');
                \Storage::disk('local')->put($img_storage_path, \File::get($file));
            }
            return redirect()->back();
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
                    'replace_num' => $request->replace_num,
                    'activo' => $request->activo == null ? 1 : $request->activo,
                    'seccion' => $request->seccion,
                    'categoria' => $request->categoria,
                    'marca' => $request->marca==null ? '': $request->marca,
                    'descripcion' => $request->descripcion,
                ]);
            if($request->file('img') != ''){
                
                $producto = \DB::table('productos')->select('seccion', 'categoria', 'img')->get()[0];
                $categoria = \DB::table('secciones')->select('nombre')->where('id', $producto->categoria)->get()[0];
                if(\File::exists(public_path("images/productos/".str_replace(' ', '_', $producto->seccion)."/".$categoria->nombre."/".$producto->img))){
                    \File::delete(public_path("images/productos/".str_replace(' ', '_', $producto->seccion)."/".$categoria->nombre."/".$producto->img));
                }
                \Storage::disk('local')->put("productos/".str_replace(' ', '_', $producto->seccion)."/".$categoria->nombre."/".$producto->img, \File::get($request->file('img')));
            }
            return redirect()->back()->with('alert', "Registro actualizado");
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

    public function edit($id){}
}
