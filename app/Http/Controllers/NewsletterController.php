<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index(){
        return \DB::table('newsletter')->select('id', 'nombre', 'email',)->get();
    }

    public function show($id){
        return (\DB::table('newsletter')->select('id', 'nombre', 'email')->where('id', $id)->get())[0];
    }

    public function store(Request $request){
        $newsletter = \DB::table('newsletter')->insert([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'created_at' => date('Y-m-d h:i:s')
        ]);

        return 'Registro realizado';
    }

    public function update(Request $request, $id){
        $newsletter = \DB::table('newsletter')->where('id', $id)
            ->update([
                'nombre' => $request->nombre,
                'email' => $request->email,
                'updated_at' => date('Y-m-d h:i:s')
            ]);
        return 'Registro actualizado';
    }

    public function delete($id){
        $activo = (\DB::table('newsletter')->where('id', $id)->select('activo')->get())[0]->activo;

        $newsletter = \DB::table('newsletter')->where('id', $id)
            ->update([
                'activo' => $activo == 1 ? 0 : 1
            ]);
        return $activo == 1 ? 'Registro eliminado' : 'Registro restaurado';
    }

    public function verificar($id){
        $newsletter = \DB::table('newsletter')->where('id', $id)
        ->update([
            'verificado' => 1
        ]);

        return 'Registro verificado';
    }
}
