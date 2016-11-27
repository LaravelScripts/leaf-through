<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contracts\{MailboxContract, CategoryGroupsContract};
use App\Traits\ReadabilityMode;
use App\Traits\JsonResponse;

class HomeController extends Controller
{
  use ReadabilityMode, JsonResponse;

  private $mailbox;
  private $categoryGroups;
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct(MailboxContract $mailbox, CategoryGroupsContract $categoryGroup)
  {
    //$this->middleware('auth');
    $this->mailbox = $mailbox;
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
    return view('home', ['mailbox' => $this->mailbox->show(), 'categoryGroups' => $this->categoryGroup->withCategorizedMail()]);
  }

}
