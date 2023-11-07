<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class FeArticleController extends Controller
{
    public function detail (Request $request, $slug) {
        $article = Article::where('slug', $slug)->first();
        return response()->json([
            "data" => $article,
            "status" => "Success",
            "message" => "Lấy bài viết thành công!"
        ]);
    }
}
