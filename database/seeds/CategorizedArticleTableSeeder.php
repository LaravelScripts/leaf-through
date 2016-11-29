<?php

use Illuminate\Database\Seeder;
use App\CategorizedArticle;

class CategorizedArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $new = new CategorizedArticle;
        $new->category_group_id = 1;
        $new->article_id = 1;
        $new->save();

        $new = new CategorizedArticle;
        $new->category_group_id = 1;
        $new->article_id = 2;
        $new->save();
    }
}
