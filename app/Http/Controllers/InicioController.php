<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index(){
        $secciones = \DB::table('categorias')->get();

        $data = array();
            foreach($secciones as $s){
            $categorias = \DB::table('secciones')->where('id_categoria',$s->id)->get();
            $s->categories = $categorias;
            array_push($data, $s);
            }
        $congse =\DB::table('productos')->select('title','sku','img')->where('seccion','Consumibles GSE')->orderBy(\DB::raw('RAND()'))->get();
        $conav =\DB::table('productos')->select('title','sku','img')->where('seccion','Consumibles Aviación')->orderBy(\DB::raw('RAND()'))->get();
        return view('index')->with('congse',$congse)->with('conav',$conav)->with('data',$data)->with('sucriptores',$suscriptores);
    }
}
