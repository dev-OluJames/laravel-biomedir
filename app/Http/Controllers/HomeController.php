<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $statement = DB::table('articles')
            ->leftJoin('categories as c','articles.categorie_id','=','c.id')
            ;


        $articles = $statement
            ->select('articles.*', 'c.category_name')
            ->get();

        $labo = $this->getSelect('Laboratoire',8);

        $chirurgie = $this->getSelect('Chirurgie');

        $imagerie = $this->getSelect('Imagerie');

        $orl = $this->getSelect('Orl');

        $autres = $this->getSelect('Equipements et Accessoires'.'and'.' c2.category_name'.'='.'Hygiène et Désinfection');

        if(Auth::check()){
            $user = Auth::user();
            $favories = User::find($user->id)->userFavories()->select('article_id','favories.id')->get();

        }else{
            $favories = null;
        }
        return view('index',['articles'=>$articles,
            'labo'=>$labo,
            'chirurgie'=>$chirurgie,
            'imagerie'=>$imagerie,
            'orl'=>$orl,
            'autres'=>$autres,
            'favories'=>$favories]);

    }

    public function product(){
        $articles = DB::table('articles')
            ->leftJoin('categories','articles.categorie_id','=','categories.id')
            ->select('articles.*', 'categories.category_name')
            ->paginate(10);;

        return view('product',['articles'=>$articles]);
    }

    private function getSelect($categ_name,$limit=null)
    {
       $statement = DB::table('articles')
            ->leftJoin('categories as c', 'articles.categorie_id', '=', 'c.id')
            ->leftJoin('categories as c2', 'c.categorie_id', '=', 'c2.id')
            ->where('c2.category_name', '=', $categ_name)
            ->orderBy('created_at')
            ->select('articles.*', 'c.category_name', 'c2.category_name');
       if($limit != null){
           return $statement
               ->limit($limit)
               ->get();
       }
       else{
           return $statement
               ->get();
       }
    }
}
