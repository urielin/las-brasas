<?php

namespace App\Http\Controllers\Auth;
use App\User;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    protected function validatecreade(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required',
            'pass' => 'required',
        ]);
    }
     public function login(Request $request){
       $request = $request->all();
       $user = User::where('usuario' ,'=', $request['usuario'])
                   ->where('pass' ,'=', $request['pass'])
                   ->first();
       if ($user) {
         session(['user' => $user]);
         return redirect()->route('home');
       }
     }
     public function showLoginForm(){
         return view('auth.login');
     }

     public function logout(Request $request){
         Auth::logout();
         $request->session()->invalidate();
         return redirect('/');
     }
     public function username() {
        return 'usuario';
     }

}
/* $datos  = $this->validate(request(), [
     $this->username() => 'required|string',
     'pass' => 'required|string'
 ]);
 if (Auth::attempt(['usuario' => $datos['usuario'], 'password' => $datos['pass']])){
    return redirect()->route('home');
 } else {
   return redirect()->route('login');
 }*/
