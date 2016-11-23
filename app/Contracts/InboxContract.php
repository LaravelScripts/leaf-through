<?php
namespace App\Contracts;


interface InboxContract{
	public function show();
	public function store($message, $url, $sender);
}