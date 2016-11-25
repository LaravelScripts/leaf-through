<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contracts\{InboxContract, CrudContract};
use App\Traits\ReadabilityMode;

class HomeController extends Controller
{
  use ReadabilityMode;

  private $inbox;
  private $categoryGroups;
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct(InboxContract $inbox, CrudContract $categoryGroup)
  {
    //$this->middleware('auth');
    $this->inbox = $inbox;
    $this->categoryGroup = $categoryGroup;
  }

  /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $this->readableFormat("https://laravel-news.com/2016/06/look-whats-coming-laravel-5-3/");
    return view('home', ['inbox' => $this->inbox->show(), 'categoryGroups' => $this->categoryGroup->withCategorizedMail()]);
  }
}
