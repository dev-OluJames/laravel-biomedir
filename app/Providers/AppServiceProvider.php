<?php

namespace App\Providers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        //

        Schema::defaultStringLength(191);
        view()->composer('*', function ($view)
        {
            $user = Auth::user();
            $view->with('aUser', $user );
        });

        $categories = Categorie::all();
        View::share('allCateg', $categories);

        $data = DB::table('categories')->where('categorie_id', null)->get();
        View::share('listCateg', $data);

        $subcateg = DB::table('categories')->where('categorie_id', "!=",null)->get();
        View::share('subCateg', $subcateg);

        $recent_view = DB::table('articles')
            ->leftJoin('categories','articles.categorie_id','=','categories.id')
            ->select('articles.*', 'categories.category_name')
            ->orderBy('view','desc')->limit(10)
            ->get();
        View::share('recent',$recent_view);



    }
}
