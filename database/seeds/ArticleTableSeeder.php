<?php

use Illuminate\Database\Seeder;
use App\Article;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $article = new Article;
        $article->user_id = 1;
        $article->url = "http://google.com";
        $article->content = "blah blah blah";
        $article->save();

        $article = new Article;
        $article->user_id = 1;
        $article->url = "http://laravel.com";
        $article->content = "blah blah blah";
        $article->save();

        $article = new Article;
        $article->user_id = 2;
        $article->url = "http://google.com";
        $article->content = "blah blah blah";
        $article->save();
    }
}
