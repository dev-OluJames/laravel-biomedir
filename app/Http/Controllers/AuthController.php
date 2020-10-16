<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use \Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index()
    {
        if(\session()->has('user')){
            return \redirect('dashboard');
        }
        return view('login');
    }

    public function register()
    {
        return view('register');
    }
    public function postLogin(Request $request)
    {
        request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)) {
            return Redirect::to('dashboard');
        }
        else{
            return Redirect::to("login")->with('error','Vous avez entrez de mauvais identifiants');
        }

    }

    public function postRegister(Request $request){
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password'=>'required|min:6'
        ]);
        //$u = (array) DB::table('users')->get();

        $data =\request()->input();
        if($data['password'] != $data['confirm_password']){
            return Redirect::to("register")->with('error', 'Mots de passe non Identique');
        }
        $check = $this->create($request);
        return Redirect::to("login")->with('success', 'Inscription complete. Connectez vous');
    }

    public function dashboard(Request $request){
        if(Auth::check()){
            $data = Auth::user();
            $request->session()->put('user', $data['name']);
            if($data['user_type'] == "super_admin"){
                return view('admin.dashboard',["data"=>$data]);
            }
            return view('dashboard',["data"=>$data]);
        }
        else{
            return Redirect::to("login")->with('info', 'Veuillez vous connecter');
        }

    }

    public function create(Request $request)
    {
        $u = User::all();
        $user = new User;
        if( $u->isEmpty()){

            $user->name = $request->name;
            $user->email = $request->email;
            $user->user_type = 'super_admin';
            $user->user_state = 'actif';
            $user->slug = Str::slug($request->name,'-');
            $user->password = Hash::make($request->password);
            $user->save();
            return $user;
            /*return User::create([
                'name'=> $data['name'],
                'email'=> $data['email'],
                'user_type'=> "admin",
                'password'=> Hash::make($data['password'])
            ]);*/
        }
        else{
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return $user;
            /*return User::create([
                'name'=> $data['name'],
                'email'=> $data['email'],
                'password'=> Hash::make($data['password'])
            ]);*/
        }

    }


    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
}
