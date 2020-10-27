<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('article_name');
            $table->string('article_image1')->default("article_image.jpg");
            $table->string('article_image2')->nullable();
            $table->string('article_image3')->nullable();
            $table->string('article_model');
            $table->string('article_details')->nullable();
            $table->integer('article_promotion')->nullable();
            $table->boolean('article_version')->nullable();
            $table->boolean('article_available')->nullable();
            $table->string('slug')->nullable();
            $table->text('article_description');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('categorie_id')->constrained('categories');
            $table->unique(array('article_name', 'article_model'));
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('articles');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
