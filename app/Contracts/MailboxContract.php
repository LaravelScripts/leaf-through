<?php
namespace App\Contracts;

use App\Contracts\CrudContract;

interface MailboxContract extends CrudContract{
	public function show();
}
