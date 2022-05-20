<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return \DB::table('users')->select('name', 'email', 'created_at')->get();
    }

    public function show($id){
        return (\DB::table('users')->select('name', 'email', 'created_at')->where('id', $id)->get())[0];
    }

    public function update(Request $request, $id){
        $user = \DB::table('users')->where('id', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'updated_at' => date('Y-m-d h:i:s')
            ]);
        return 'Usuario actualizado';
    }

    public function delete($id){
        $activo = (\DB::table('users')->where('id', $id)->select('activo')->get())[0]->activo;

        $user = \DB::table('users')->where('id', $id)
            ->update([
                'activo' => $activo == 1 ? 0 : 1
            ]);
        return $activo == 1 ? 'Usuario eliminado' : 'Usuario restaurado';
        
    }
}
