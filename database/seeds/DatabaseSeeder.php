<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(ArticleTableSeeder::class);
        $this->call(MailboxTableSeeder::class);
        $this->call(CategoryGroupsTableSeeder::class);
        $this->call(CategorizedArticleTableSeeder::class);
    }
}
