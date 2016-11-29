<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contracts\ArticleContract;

use App\Traits\{ReadabilityMode, JsonResponse};

class ArticleController extends Controller
{
    use ReadabilityMode, JsonResponse;
    //
    public function store(Request $request, ArticleContract $article){
        $validator = \Validator::make($request->all(), ['url' => 'required']);

        if($validator->fails()){
          return $this->jsonError($validator->messages());
        }

        if(!is_null($article->urlMatch($request->input('url')))){
            return $this->jsonError("Article Exists.");
        }

        $html = file_get_contents($request->input('url'));
        /*libxml_use_internal_errors(true);
        $dom = new \DOMDocument;
        $dom->loadHtmlFile($html);
        $xpath = new \DOMXpath($dom);

        dd($xpath->query('//div/[@itemprop="description"]')->item(0)->nodeValue);*/
        $articleData = $this->readableFormat($request->input('url'), $html);
        if(array_key_exists("error", $articleData)){
            return $this->jsonError("Unable to fetch Article.");
        }
        
        $articleData['url'] = $request->input('url');
        return $article->save($articleData) == true ? $this->jsonSuccess('Article saved successfully') : $this->jsonError('Error in insertion');

    }
}
