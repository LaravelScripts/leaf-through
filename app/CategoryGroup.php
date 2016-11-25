<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryGroup extends Model
{
    //
    public function categorizedMail(){
      return $this->hasMany('App\CategorizedMail','category_group_id');
    }
}
