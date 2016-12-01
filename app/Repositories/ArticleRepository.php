<?php

namespace App\Repositories;

use App\Contracts\ArticleContract;
use App\Article;

class ArticleRepository implements ArticleContract{

      public function save(array $articleData){
          $article = new Article;
          $article->user_id = \Auth::user()->id;
          $article->url = $articleData['url'];
          $article->title = $articleData['title'];
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
              $massInsert->push(["user_id" => $id , "url"=> $articleData['url'], "title" => $articleData['title'],"content"=> $articleData['content'], "updated_at"=> \Carbon\Carbon::now(),"created_at" => \Carbon\Carbon::now()]);
          });

          Article::insert($massInsert->toArray());

          return \DB::getPdo()->lastInsertId(); //Its the first insertion Id. Don't be fooled by the name
      }

      public function urlMatch($url){
          return Article::where('url', $url)->where('user_id', \Auth::user()->id)->first();
      }

      public function fetch($id){
          return Article::where('id', $id)->first(); //Gate read-article will take care of user. ->where('user_id', \Auth::user()->id)
      }

      public function create(){}
      public function read(){}
      public function update(){}

      public function delete($id){
          return Article::delete($id);
      }
}
