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