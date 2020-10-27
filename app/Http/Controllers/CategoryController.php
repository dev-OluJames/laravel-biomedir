<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function addCategory(Request $request){
        request()->validate([
            'category_name' => 'required',
            'category_icon' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $category = new Categorie;
        $results = DB::table('categories')->where('category_name','=',$request->categorie_id);

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

        if ($request->categorie_id and $request->categorie_id != "none"){
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
