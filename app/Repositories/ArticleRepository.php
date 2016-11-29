<?php

namespace App\Repositories;

use App\Contracts\ArticleContract;
use App\Article;

class ArticleRepository implements ArticleContract{

      public function save(array $articleData){
          $article = new Article;
          $article->user_id = \Auth::user()->id;
          $article->url = $articleData['url'];
          $article->content = $articleData['content'];
          $article->save();
          return $article;
      }

      /**
      *
      */
      public function saveForRecipients(array $articleData, \Illuminate\Support\Collection $recipients): int{
          $massInsert = collect([]);
          $recipients->each(function ($id) use ($massInsert, $articleData){
              $massInsert->push(["user_id" => $id , "url"=> $articleData['url'], "content"=> $articleData['content'], "updated_at"=> \Carbon\Carbon::now(),"created_at" => \Carbon\Carbon::now()]);
          });

          Article::insert($massInsert->toArray());

          return \DB::getPdo()->lastInsertId(); //Its the first insertion Id. Don't be fooled by the name
      }

      public function urlMatch($url){
          return Article::where('url', $url)->where('user_id', \Auth::user()->id)->first();
      }


      public function create(){}
      public function read(){}
      public function update(){}
      public function delete(){}
}
