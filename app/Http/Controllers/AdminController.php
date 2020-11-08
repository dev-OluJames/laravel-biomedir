<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Contact;
use App\Models\User;
use Doctrine\DBAL\Driver\IBMDB2\DB2Connection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;



class AdminController extends Controller
{

    public function admins(){
        if ($this->actifCheck()){
            $users = User::all();
            return view('admin.admins',['users'=>$users]);
        }else{
            return redirect('no_access');
        }

    }

    public function showAdmin($slug,$id){
        if ($this->actifCheck()){
            $id = intval($id);
            $user = DB::table('users')->where('id','=',$id)->get();
            $user = $user[0];
            return view('admin.show_user',['user'=>$user]);
        }else{
            return redirect('no_access');
        }

    }

    public function editAdmin(Request $request,$slug,$id){
        if($this->actifCheck()){
            $user = User::find($request->id);
            $user->user_type = $request->type;
            $user->user_state = $request->state;
            $user->save();
            return redirect('admins')->with('success','Vos Modifications ont été enregistré');
        }else{
            return redirect('no_access');
        }

    }

    public function contact(){
        if(Auth::check()){
            $user = Auth::user();
            return view('contact',['user'=>$user]);
        }else{
            return view('contact');
        }

    }

    public function send_email(Request $request){
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;
        if($request->has('phone')){
            $contact->phone = $request->phone;
        }
        if(Auth::check()){
            $user = Auth::user();
            $contact->user_id = $request->id;
        }
        $req = (array) $request;
        try {
            /*Mail::send('mail', ["request_message"=>$request->message,'request_email'=>$request->email], function($message) use ($request) {
                $message->from($request->email, $request->email);
                $message->sender($request->email, $request->email);
                $message->to('biomedir.togo@gmail.com')->subject($request->subject);
            });*/
            Mail::to('biomedir.togo@gmail.com')->send(new ContactMail($request->email));
            $contact->save();
        }catch (\Swift_SwiftException $exception){
            return back()->with('error',$exception->getMessage());
        }
        return back()->with('success','Votre mail a été bien envoyé');
    }

    public function after($start, $inthat)
    {
        if (!is_bool(strpos($inthat, $start)))
            return substr($inthat, strpos($inthat,$start)+strlen($start));
    }

    private function actifCheck(){
        $user = Auth::user();
        if($user->user_state =='actif'){
            return true;
        }else{
            return false;
        }
    }




}
