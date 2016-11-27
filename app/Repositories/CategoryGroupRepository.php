<?php
namespace App\Repositories;

use App\CategoryGroup;
use App\Contracts\CategoryGroupsContract;

class CategoryGroupRepository implements CategoryGroupsContract{

  /**
  * To display all the categories of a particular user.
  */
  public function read(): \Illuminate\Database\Eloquent\Collection{
    return CategoryGroup::where('user_id', \Auth::user()->id)->get();
  }

  public function create(): \Illuminate\Database\Eloquent\Collection{
    return CategoryGroup::where('user_id', \Auth::user()->id)->get();
  }

  public function delete(): \Illuminate\Database\Eloquent\Collection{
    return CategoryGroup::where('user_id', \Auth::user()->id)->get();
  }

  public function update(): \Illuminate\Database\Eloquent\Collection{
    return CategoryGroup::where('user_id', \Auth::user()->id)->get();
  }

  public function withCategorizedMail(){
    return CategoryGroup::with('categorizedMail')->where('user_id', \Auth::user()->id)->get();
  }

  public function show(){}
}
