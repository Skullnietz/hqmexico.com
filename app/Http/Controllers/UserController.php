<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $usuarios =\DB::table('users')->select('name', 'email','activo', 'created_at')->get();
        return view('usuarios.index')->with('usuarios',$usuarios);
    }

    public function userList(){
        $usuarios =\DB::table('users')->select('id', 'name', 'email','activo', 'created_at')->get();
        return json_encode(array(['data' => $usuarios]));
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
            ->delete();
        return array(['deleted' => true]);

    }

    public function setActivo($id){
        $activo = (\DB::table('users')->where('id', $id)->select('activo')->get())[0]->activo;

        $user = \DB::table('users')->where('id', $id)
            ->update([
                'activo' => $activo == 1 ? 0 : 1
            ]);
        return array($activo == 1 ? ['activo' => 'eliminado'] : ['activo' => 'autorizado']);

    }

    public function create(){

        return view('usuarios.create');

    }
}
