<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        //$articles = Article::all();
        $articles = DB::table('articles')
            ->leftJoin('categories','articles.categorie_id','=','categories.id')
            ->select('articles.*', 'categories.category_name')
            ->get();

        return view('index',['articles'=>$articles]);
    }

    public function product(){
        $articles = DB::table('articles')
            ->leftJoin('categories','articles.categorie_id','=','categories.id')
            ->select('articles.*', 'categories.category_name')
            ->paginate(10);;

        return view('product',['articles'=>$articles]);
    }
}
