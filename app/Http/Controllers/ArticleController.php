<?php


namespace App\Http\Controllers;

use App\models\offer;

class ArticleController extends Controller
{
    public function articles()
    {
        $articles = offer::get();
        dd($articles);

    }

}
