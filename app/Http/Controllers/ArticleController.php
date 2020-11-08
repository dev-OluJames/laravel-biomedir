<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function preAddArticle($slug){
        $sub_category =DB::table('categories')->where('slug','=',$slug)->get();
        $category = Categorie::find($sub_category[0]->categorie_id);
        $article = new Article();
        return view('admin.addarticle',['sub_category'=>$sub_category,'category'=>$category, 'article'=>$article]);
    }

    public function addArticle(Request  $request){
        request()->validate([
            'article_name' => 'required',
            'article_description' => 'required',
            'article_image1' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'article_image2' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'article_image3' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if(Auth::check()){
            $data = Auth::user();
            if($data['user_type']=='admin' or $data['user_type']=='super_admin' and $data['user_state']=='actif'){
                $article = new Article();
                return $this->saveArticle($request, $article, $data, 'Votre article a été bien ajouté');
            }
            return redirect("no_access");
        }
        else{
            return redirect("login")->with('info','Vous devez vous connecter avant d effecter cette Opération');
        }
    }

    public function show_article($slug){
        $data = DB::table('articles')->where('slug','=', $slug)->get();
        if(sizeof($data) != 0) {
            $article = Article::find($data[0]->id);
            $article->view += 1;
            $article->save();
            $category = DB::table('categories')->where('id','=',$article->categorie_id)->get();
            $sub_category = Categorie::find($category[0]->id);
            return view('admin.show_article',['article'=>$article, 'sub_category'=>$sub_category]);
        }else{
            return abort(404);
        }

    }

    public function preEdit_article($slug){
        $data = DB::table('articles')->where('slug','=', $slug)->get();
        if(sizeof($data) != 0){
            $article = Article::find($data[0]->id);
            $sub_category = DB::table('categories')->where('id','=', $article->categorie_id)->get();
            $categ = DB::table('categories')->where('id','=', $sub_category[0]->id)->get();
            $category = Categorie::find($categ[0]->id);
            return view('admin.addarticle',['article'=>$article,'sub_category'=>$sub_category,'category'=>$category]);
        }
        else{
            return abort(404);
        }
    }

    public function edit_article(Request $request){
        $article = Article::find($request->id);
        if(Auth::check()){
            $data = Auth::user();
            if($data['user_type']=='admin' or $data['user_type']=='super_admin' and $data['user_state']=='actif'){
                return $this->saveArticle($request, $article, $data, 'Votre article a été bien modifié');
            }
            return redirect("no_access");
        }
        else{
            return redirect("login")->with('info','Vous devez vous connecter avant d effecter cette Opération');
        }


    }

    public function delete_article($id){
        $i = (int)$id;
        $data = Article::find($i);
        $category = DB::table('categories')->where('id','=',$data->categorie_id)->get();
        $data->delete();
        return redirect()->route('categorie',['slug'=>$category[0]->slug])->with('success','Donnée Suprimé');
    }

    /**
     * @param Request $request
     * @param Article $article
     * @param Authenticatable|null $data
     * @param $messsage
     * @return \Illuminate\Http\RedirectResponse
     */
    private function saveArticle(Request $request, Article $article, ?Authenticatable $data, $messsage): \Illuminate\Http\RedirectResponse
    {

        $article->article_name = $request->article_name;
        $article->article_model = $request->article_model;
        $article->slug = Str::slug($request->article_name, '-') . '-' . Str::slug($request->article_model, '-');

        if ($request->article_details) {
            $article->article_details = $request->article_details;
        }
        if ($request->has('article_available')) {
            $article->article_available = 1;
        }
        if ($request->has('article_version')) {

            $article->article_version = 1;
        }
        else{
            $article->article_version = 0;
        }
        if ($request->has('trends')) {

            $article->trends = 1;
        }
        else{
            $article->trends = 0;
        }
        if ($request->has('medweek')) {

            $article->medweek = 1;
        }
        else{
            $article->medweek = 0;
        }
        $article->article_promotion = $request->article_promotion;
        //dd( request()->article_image1);
        $this->checkImage($request, 'article_image1', $article);

        $this->checkImage($request, 'article_image2', $article);

        $this->checkImage($request, 'article_image3', $article);

        $article->article_description = $request->article_description;
        $subCateg = DB::table('categories')->where('category_name', $request->categorie_id)->get();

        $article->categorie_id = $subCateg[0]->id;
        $article->user_id = $data['id'];
        try {
            $article->save();
        } catch (QueryException $exception) {
            //return back()->with('error', 'Erreur de Duplicatat!!! l article ' . $article->article_name . ' de model' . $article->article_model . ' existe deja');
            return back()->with('error', $exception->getMessage());
        }
        return redirect()->route('categorie',['slug'=>$subCateg[0]->slug])->with('success', $messsage);
    }

    private function checkImage(Request $request, $file_name, $data)
    {

        if($request->hasFile($file_name)){
            $image = trim($file_name, '"');
            $imageName = $image.time().'.'.request()->$image->getClientOriginalExtension();
            $data-> $image = $imageName;
            request()->$file_name->move(public_path('asset/images'), $imageName);

        }
    }
}
