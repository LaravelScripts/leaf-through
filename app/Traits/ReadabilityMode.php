<?php
namespace App\Traits;

use Readability\Readability;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

trait ReadabilityMode{

  /**
  *
  */
  function readableFormat($url): array{
      $client = new \GuzzleHttp\Client();
      $res = $client->request('GET',
                                'https://mercury.postlight.com/parser?url='.$url,
                                [ 'headers' =>
                                        [ 'User-Agent' => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; it; rv:1.8.1.11)',
                                            'Content-Type' => 'application/json',
                                            'x-api-key' => 'HPLqb1Emtpz7DpVkDOzXGRCOi4LkwKszEcPNwoVB'
                                        ]
                                    ]
                                );

    return json_decode($res->getBody(), true);
  }

}
