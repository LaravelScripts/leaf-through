<?php

use Illuminate\Support\Facades\DB;

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

function setting(string $item) :string {
	return collect(getAllSettings())->filter(function($value, $key) use ($item) {
		return $value->name === $item;
	})->pluck('value')->first();
}

function mailbox() :  \Illuminate\Support\Collection {
    return DB::table('mailbox')
            ->join('users', 'mailbox.sender_id', '=', 'users.id')
            ->where('mailbox.user_id', auth()->user()->id)
            ->select('mailbox.url', 'mailbox.message', 'users.name as sender')
            ->get();
}

function categories() : \Illuminate\Support\Collection {
    return DB::table('category_groups')
            ->join('categorized_mails', 'categorized_mails.category_group_id', '=', 'category_groups.id')
            ->join('users', 'category_groups.user_id', '=', 'users.id')
            ->where('category_groups.user_id', auth()->user()->id)
            ->get();
}
