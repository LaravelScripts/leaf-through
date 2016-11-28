<?php

/**
 * Returns how long it takes to read an article
 *
 * @param  string  $text   The text
 *
 * @return string
 */
function timeToRead($text) {

    $words = str_word_count(strip_tags($text));
	$min = floor($words / 200);

	if((int) $min === 0){
		return '1 min read';
	}

	return $min . ' mins read';
}

function getAllSettings()
{
	return cache()->rememberForever('settings', function () {
    	return \DB::table('settings')->get();
	});
}

function setting($item)
{
	return collect(getAllSettings())->filter(function($value, $key) use ($item) {
		return $value->name === $item;
	})->pluck('value')->first();
}