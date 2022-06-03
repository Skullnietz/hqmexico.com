<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index(){
        $productos =\DB::table('productos')->select('title','sku','img')->get();
        return view('index')->with('productos',$productos);
    }
}
