<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryGroup extends Model
{
    //
    public function categorizedArticle(){
      return $this->hasMany('App\CategorizedArticle','category_group_id');
    }
}
