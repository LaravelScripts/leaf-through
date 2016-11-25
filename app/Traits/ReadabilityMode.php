<?php
namespace App\Traits;

use Readability\Readability;

trait ReadabilityMode{

  function readableFormat($url){
    // you can use whatever you want to retrieve the html content (Guzzle, Buzz, cURL ...)
    $html = file_get_contents($url);

    $readability = new Readability($html, $url);
    // or without Tidy
    // $readability = new Readability($html, $url, 'libxml', false);
    $result = $readability->init();

    if ($result) {
      return $readability;
    } else {
        return false;
    }
  }

}
