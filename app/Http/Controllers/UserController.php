<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Favorie;
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

    public function userPreferences($id){
        if(Auth::check()){
            $user = Auth::user();
            $favorie = new Favorie();
            $favorie->user_id = $user->id;
            $favorie->article_id = $id;
            $favorie->save();
            return back()->with('succes','Article Ajouté à vos liste de favories');
        }else{
            return redirect('login')->with('info','Veuillez bien vous Conecter avant d efectuer cette opération');
        }

    }

    public function removePreferences($id){
        if(Auth::check()){
            $favorie = Favorie::find($id);
            $favorie->delete();
            return back()->with('succes','Article retiré de favories');
        }
    }

}
