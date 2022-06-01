<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsletterController extends Controller
{
    public function index(){
        $user = Auth::user() == null ? false: true;
        if($user){
            return \DB::table('newsletter')->select('id', 'nombre', 'email',)->get();
        }else{
            return redirect(route('login'));
        }
    }

    public function show($id){
        $user = Auth::user() == null ? false: true;
        if($user){
            return (\DB::table('newsletter')->select('id', 'nombre', 'email')->where('id', $id)->get())[0];
        }else{
            return redirect(route('login'));
        }
    }

    public function store(Request $request){
        $user = Auth::user() == null ? false: true;
        if($user){
            $newsletter = \DB::table('newsletter')->insert([
                'nombre' => $request->nombre,
                'email' => $request->email,
                'created_at' => date('Y-m-d h:i:s')
            ]);

            return 'Registro realizado';
        }else{
            return redirect(route('login'));
        }
    }

    public function update(Request $request, $id){
        $user = Auth::user() == null ? false: true;
        if($user){
            $newsletter = \DB::table('newsletter')->where('id', $id)
                ->update([
                    'nombre' => $request->nombre,
                    'email' => $request->email,
                    'updated_at' => date('Y-m-d h:i:s')
                ]);
            return 'Registro actualizado';
        }else{
            return redirect(route('login'));
        }
    }

    public function delete($id){
        $user = Auth::user() == null ? false: true;
        if($user){
            $activo = (\DB::table('newsletter')->where('id', $id)->select('activo')->get())[0]->activo;

            $newsletter = \DB::table('newsletter')->where('id', $id)
                ->delete();
            return array(['deleted' => true]);
        }else{
            return redirect(route('login'));
        }
    }

    public function verificar($id){
        $user = Auth::user() == null ? false: true;
        if($user){
            $newsletter = \DB::table('newsletter')->where('id', $id)
            ->update([
                'verificado' => 1
            ]);

            return 'Registro verificado';
        }else{
            return redirect(route('login'));
        }
    }
}
