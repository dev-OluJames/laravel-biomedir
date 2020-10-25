<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Article;
use App\Models\Categorie;
use App\Models\Contact;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;


class AdminController extends Controller
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
        $article = Article::find($data[0]->id);
        $article->view += 1;
        $article->save();
        $category = DB::table('categories')->where('id','=',$article->categorie_id)->get();
        $sub_category = Categorie::find($category[0]->id);
        return view('admin.show_article',['article'=>$article, 'sub_category'=>$sub_category]);
    }

    public function preEdit_article($slug){
        $data = DB::table('articles')->where('slug','=', $slug)->get();
        $article = Article::find($data[0]->id);
        $sub_category = DB::table('categories')->where('id','=', $article->categorie_id)->get();
        $categ = DB::table('categories')->where('id','=', $sub_category[0]->id)->get();
        $category = Categorie::find($categ[0]->id);
        return view('admin.addarticle',['article'=>$article,'sub_category'=>$sub_category,'category'=>$category]);
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

    public function addCategory(Request $request){
        request()->validate([
            'category_name' => 'required',
            'category_icon' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $category = new Categorie;
        $results = DB::select('select * from categories where category_name = :id', ['id' => $request->categorie_id]);

        if(!empty($results)){
            $category->categorie_id=$results[0]->id;
            $category->slug = Str::slug($request->category_name,'-');
        }
        $category->category_name = $request->category_name;

        $this->checkImage($request,'category_icon',$category);
        try {
            $category->save();
        } catch (QueryException $exception) {

            return back()->with('error','Erreur de Duplicatat!!! le champ '.$category->category_name.' existe deja');
        }

        return redirect("add_categories")->with("success",'Vos données ont été Enregistrés');

    }



    public function listCategory(){
        //$data = DB::table("categories")->get();
        $data = DB::table('categories')->where('categorie_id', null)->get();

        return view('admin.categorie', ['data'=>$data]);
    }

    public function showCategory($slug){
       $data = DB::table('categories')->where('slug', '=', $slug)->get();
       $category = Categorie::find($data[0]->categorie_id);
       $parent_categ = null;
        if($category and $category->categorie_id){
            $parent_categ = Categorie::find($category->categorie_id);
        }
       $items = DB::table('articles')->where('categorie_id', "=",$data[0]->id)
           ->paginate(10);
       $sub_categ = DB::table('categories')->where('categorie_id', $data[0]->id)->get();
       return view('admin.show_categories',['data'=>$data,
                                                    'category'=>$category,
                                                    'sub_categ'=>$sub_categ,
                                                    'items'=>$items,'parent_categ'=>$parent_categ]);
    }

    public function editCategory(Request $request){
        request()->validate([
            'category_name' => 'required',
            'category_icon' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $category = Categorie::find($request->id);

        $category->category_name = $request->category_name;
        $category->slug = Str::slug($request->category_name,'-');
        if ($request->categorie_id){
            $results = DB::select('select * from categories where category_name = :id', ['id' => $request->categorie_id]);
            $category->categorie_id=$results[0]->id;
        }
        $this->checkImage($request,'category_icon',$category);
        try {
            $category->save();
        } catch (QueryException $exception) {

            return back()->with('error','Erreur de Duplicatat!!! le champ '.$category->category_name.' existe deja');
        }
        //flash("Vos données ont été Enregistrés")->success();
        return redirect()->route('categorie',['slug'=>$category->slug])->with('success','Vos données ont été Modifié');
    }

    public function preAddSubCategory($slug){
        $data = DB::table('categories')->where('slug','=',$slug)->get();
        $category = Categorie::find($data[0]->id);
        $parent_categ = null;
        if($category and $category->categorie_id){
            $parent_categ = Categorie::find($category->categorie_id);
        }
        return view('admin.add_sub_categories',['category'=>$category, 'parent_categ'=>$parent_categ]);
    }

    public function addSubCategory(Request $request){
        request()->validate([
            'category_name' => 'required',
            'category_icon' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        $sub_category = new Categorie();
        $sub_category->category_name = $request->category_name;

        $category = DB::table('categories')->where('category_name', '=',$request->categorie_id)->get();
        $sub_category->slug = Str::slug($request->category_name,'-');
        $sub_category->categorie_id = $category[0]->id;
        $this->checkImage($request,'category_icon',$sub_category);
        try {
            $sub_category->save();
        } catch (QueryException $exception) {
            echo $exception->getMessage();
            return back()->with('error','Erreur de Duplicatat!!! le champ '.$sub_category->category_name.' existe deja');
        }
        return redirect()->route('categorie',['slug'=>$category[0]->slug])->with('success','Votre Ajout a été enregistré');


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
