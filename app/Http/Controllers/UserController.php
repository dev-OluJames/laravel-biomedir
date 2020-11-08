<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function userAccount($slug,$id){
        if(Auth::check()){
            $user = User::find($id);
            return view('user_account',['user'=>$user]);
        }
        else{
            return redirect('login')->with('info','Veuillez d abord vous connecter');
        }

    }

    public function editAccount(Request $request)
    {
        if(Auth::check()){
            $rules = ['email' => 'required|unique:users,email,' . $request->id,];
            $customMessages = [
                'required' => 'The :attribute field is required.',
                'unique'=>'email: '.$request->email.' has been already taken',
            ];
            $this->validate($request,$rules,$customMessages);
            //ddd($request);
            $user = User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            if($request->has('address')){
                $user->user_address = $request->address;
            }
            if($request->has('phone')){
                $user->phone_number = $request->phone;
            }
            $user->save();
            return redirect('dashboard')->with('success','Vos Informations ont été mis à jours');
        }else{
            return redirect('login')->with('info','Veuillez d abord vous connecter');
        }

    }
}
