<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request) {
        
        $articles = Article::with('categories')
            ->where(function ($query) use ($request) {
                if (!empty($request->get('articulo'))) {
                    $query->where('name', 'like', "%{$request->get('articulo')}%");
                }
                if (!empty($request->get('descripcion'))) {
                    $query->where('description', 'like', "%{$request->get('descripcion')}%");
                }
            })->get();
        if (!empty($request->get('categoria'))) {
            $articlesId = array();
            $categoryRequest = textTransform($request->get('categoria'));
            foreach ($articles as $article) {
                $addId = null;
                foreach ($article->categories as $category) {
                    $name = textTransform($category->name);
                    if (str_contains($name, $categoryRequest)) {
                        $addId = $article->id;
                        break;
                    }
                }
                if ($addId) $articlesId[] = $addId;
            }
            $articles = $articles->only($articlesId);
        }
        return responseJson(true, 'Artículos', 200, $articles);
    }
}
