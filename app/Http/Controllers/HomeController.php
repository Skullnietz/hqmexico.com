<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user() == null ? false: true;
        if($user){
            $productos = \DB::table('productos')->count();
            $suscriptores = \DB::table('newsletter')->count();

            return view('home')
                ->with('productos', $productos)
                ->with('suscriptores', $suscriptores);
        }else{
            return redirect(route('login'));
        }
    }




    public function changePassword()
    {
        return view('changepassword');
    }
    public function updatePassword(Request $request)
    {

        $request->validate([
            'contraseña' => 'required',
            'nueva_contraseña' => 'required|confirmed',
        ]);
        if(!Hash::check($request->contraseña, auth()->user()->password)){
            return back()->with("error","La contraseña no es correcta");
        }
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->nueva_contraseña)

        ]);
        return back()->with("status","Contraseña cambiada satisfactoriamente");
    }
}
