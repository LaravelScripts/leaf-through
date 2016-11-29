<?php

use Illuminate\Support\Facades\DB;

use App\Repositories\{MailboxRepository, CategoryGroupRepository};

/**
 * Returns how long it takes to read an article
 *
 * @param  string  $text   The text
 *
 * @return string
 */
function timeToRead(string $text) :string {

    $words = str_word_count(strip_tags($text));
	$min = floor($words / 200);

	if((int) $min === 0){
		return '1 min read';
	}

	return $min . ' mins read';
}

function getAllSettings() :array {
	return cache()->rememberForever('settings', function () {
    	return DB::table('settings')->get();
	})->toArray();
}

function setting(string $item): string{
	$settings = collect(getAllSettings())->filter(function($value, $key) use ($item) {
		return $value->name === $item;
	})->pluck('value')->first();

    return $settings ?? '';
}

function mailbox() :  \Illuminate\Support\Collection {
    $mailboxRepo = new MailboxRepository;
    return $mailboxRepo->show();
}

function categories() : \Illuminate\Support\Collection {
    $categoryGroupRepo = new CategoryGroupRepository;
    return $categoryGroupRepo->withCategorizedArticle();
}
