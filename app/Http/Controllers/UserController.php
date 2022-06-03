<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $user = Auth::user() == null ? false: true;
        if($user){
            $usuarios =\DB::table('users')->select('name', 'email','activo', 'created_at')->get();
            return view('usuarios.index')->with('usuarios',$usuarios);
        }else{
            return redirect(route('login'));
        }
    }

    public function userList(){
        $user = Auth::user() == null ? false: true;
        if($user){
            $usuarios =\DB::table('users')->select('id', 'name', 'email','activo', 'created_at')->get();
            return json_encode(array(['data' => $usuarios]));
        }else{
            return redirect(route('login'));
        }
    }

    public function show($id){
        $user = Auth::user() == null ? false: true;
        if($user){
            $usuario = (\DB::table('users')->select('id', 'name', 'email', 'created_at')->where('id', $id)->get());
            return view('usuarios.edit')
                ->with('usuario',$usuario);
        }else{
            return redirect(route('login'));
        }
    }

    public function update(Request $request, $id){
        $user = Auth::user() == null ? false: true;
        if($user){
            $user = \DB::table('users')->where('id', $id)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'updated_at' => date('Y-m-d h:i:s')
                ]);
            $user = (\DB::table('users')->select('name', 'email', 'created_at')->where('id', $id)->get());
            return redirect(route('usershow', ['id'=>$id]));
        }else{
            return redirect(route('login'));
        }
    }

    public function delete($id){
        $user = Auth::user() == null ? false: true;
        if($user){
            $activo = (\DB::table('users')->where('id', $id)->select('activo')->get())[0]->activo;

            $user = \DB::table('users')->where('id', $id)
                ->delete();
            return array(['deleted' => true]);
        }else{
            return redirect(route('login'));
        }

    }

    public function setActivo($id){
        $user = Auth::user() == null ? false: true;
        if($user){
            $activo = (\DB::table('users')->where('id', $id)->select('activo')->get())[0]->activo;

            $user = \DB::table('users')->where('id', $id)
                ->update([
                    'activo' => $activo == 1 ? 0 : 1
                ]);
            return array($activo == 1 ? ['activo' => 'eliminado'] : ['activo' => 'autorizado']);
        }else{
            return redirect(route('login'));
        }

    }

    public function create(){
        $user = Auth::user() == null ? false: true;
        if($user){
            return view('usuarios.create');
        }else{
            return redirect(route('login'));
        }

    }
}
