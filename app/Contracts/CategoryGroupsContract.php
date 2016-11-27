<?php
namespace App\Contracts;

use App\Contracts\CrudContract;

interface CategoryGroupsContract extends CrudContract{
  public function show();
}
