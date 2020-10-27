<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;



class AdminController extends Controller
{

    public function admins(){
        $users = User::all();
        return view('admin.admins',['users'=>$users]);
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




}
