<?php
namespace App\Traits;

use Readability\Readability;

trait ReadabilityMode{

  /**
  *
  */
  function readableFormat($url, $html): array{
    if (function_exists('tidy_parse_string')) {
        $tidy = tidy_parse_string($html, array(), 'UTF8');
        $tidy->cleanRepair();
        $html = $tidy->value;
    }

    $readability = new Readability($html, $url);
    // print debug output?
    // useful to compare against Arc90's original JS version -
    // simply click the bookmarklet with FireBug's console window open
    $readability->debug = false;
    // convert links to footnotes?
    $readability->convertLinksToFootnotes = true;
    // process it
    $result = $readability->init();
    // does it look like we found what we wanted?
    if ($result) {
        $content = $readability->getContent()->innerHTML;
        // if we've got Tidy, let's clean it up for output
        if (function_exists('tidy_parse_string')) {
            $tidy = tidy_parse_string($content, array('indent'=>true, 'show-body-only' => true), 'UTF8');
            $tidy->cleanRepair();
            $content = $tidy->value;
        }
        return ["title" => htmlentities($readability->getTitle()->textContent, ENT_QUOTES), "content" => htmlentities($content, ENT_QUOTES)];
    } else {
        return ["error" => "Unable to fetch contents."];
    }
  }

}
