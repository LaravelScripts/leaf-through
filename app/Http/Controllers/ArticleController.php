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

        try{
            $articleData = $this->readableFormat(trim($request->input('url')));
        }catch(\Exception $e){
            return $this->jsonError($e->getMessage());
        }

        if(array_key_exists("error", $articleData)){
            return $this->jsonError("Unable to fetch Article.");
        }


        return $article->save($articleData) == true ? $this->jsonSuccess('Article saved successfully') : $this->jsonError('Error in insertion');

    }

    public function view(Request $request, $id, ArticleContract $articleContract){

        $article = $articleContract->fetch($id);

        if(is_null($article)){
            abort(404);
        }
        if(\Gate::allows('access-article', $article)){
            return view('home', compact('article'));
        }

        abort(404);
    }

    public function delete(Request $request, $id, ArticleContract $articleContract){

        $article = $articleContract->fetch($id);
        if(\Gate::allows('access-article', $article)){
            return $article->delete($article->id) == true ? $this->jsonError("Article deleted successfully") : $this->jsonError("Unable to delete article");
        }else{
            return $this->jsonError("Unauthorized access");
        }

    }
}
