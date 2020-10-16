<?php

namespace App\Providers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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


    }
}
