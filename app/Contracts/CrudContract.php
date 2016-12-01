<?php
namespace App\Contracts;

/**
* Common functions like Create, Update, Read and Delete in Database
*/

interface CrudContract{
  public function create();
  public function read();
  public function update();
}
