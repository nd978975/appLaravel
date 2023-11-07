<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
  public function create (Request $request) {
    Article::create([
        'name' => $request->name,
        'slug' => $request->slug,
        'des' => $request->des,
        'content' => $request->content,
        'user_id' => $request->user_id,
        'user_name' => $request->user_name,
        'category_id' => $request->category_id,
        'category_name' => $request->category_name,
        'title_seo' => $request->name,
        'description_seo' => $request->des,
        'status' => $request->status,
    ]);

    return response()->json([
        "status" => 200,
        "message" => "Create Article Successfully!"
    ]);
  }

  public function edit (Request $request) {
    $id = (int)($request->id);
    $article = Article::where("id", $id)->first();
    $article->name = $request->name;
    $article->slug = $request->slug;
    $article->des = $request->des;
    $article->title_seo = $request->name;
    $article->description_seo = $request->des;
    $article->content = $request->content;
    $article->status = $request->status;
    $article->category_id = $request->category_id;
    $article->category_name = $request->category_name;
    $article->save();
    return response()->json([
        "data" => $article,
        "status" => "Success",
        "message" => "Sửa bài viết thành công!"
    ]);
  }

  public function lists () {
    $articles = Article::withTrashed()->get();
    return response()->json([
        "data" => $articles,
        "status" => "Success",
        "message" => "Lấy danh sách bài viết thành công!"
    ]);
  }

  public function detail (Request $request, $id) {
    $article = Article::where('id', $id)->first();
    return response()->json([
        "data" => $article,
        "status" => 200,
        "message" => "Get Article Detail Successfully!"
    ]);
  }

  public function listsTrash () {
    $articles = Article::onlyTrashed()->get();
    return response()->json([
        "data" => $articles,
        "status" => "Success",
        "message" => "Lấy danh sách bài viết trong thùng rác!"
    ]);
  }

  public function moveToTrash (Request $request) {
    if(is_array($request->id)) {
      foreach ($request->id as $id) {
        $article = Article::where('id', $id)->delete();
      }
    }else {
      $article = Article::where('id', $request->id)->delete();
    }

    return response()->json([
        "status" => "Success",
        "message" => "Đã chuyển bài viết vào thùng rác!"
    ]);
  }

  public function restore (Request $request) {
    if(is_array($request->id)) {
      foreach ($request->id as $id) {
        $article = Article::withTrashed()
        ->where("id", $id)->first();
        $article->restore();
      }
    }else {
      $article = Article::withTrashed()
      ->where("id", $request->id)->first();
      $article->restore();
    }

    return response()->json([
        "status" => 200,
        "message" => "Restore Article Successfully!"
    ]);
  }

  public function delete (Request $request) {
    if(is_array($request->id)) {
      foreach ($request->id as $id) {
        $article = Article::where('id', $id)->forceDelete();
      }
    }else {
      $article = Article::where('id', $request->id)->forceDelete();
    }

    return response()->json([
        "status" => 200,
        "message" => "Delete Article Successfully!"
    ]);
  }

  public function publicItem (Request $request) {
    if(is_array($request->id)) {
      foreach ($request->id as $key => $id) {
        $article = Article::where("id", $id)->first();
        $article->status = 1;
        $article->save();
      }
    }else {
      $article = Article::where("id", $request->id)->first();
      $article->status = 1;
      $article->save();
    }

    return response()->json([
        "status" => 200,
        "message" => "Public Article Successfully!"
    ]);
  }

  public function moveToDraft (Request $request) {
    if(is_array($request->id)) {
      foreach ($request->id as $key => $id) {
        $article = Article::where("id", $id)->first();
        $article->status = 0;
        $article->save();
      }
    }else {
      $article = Article::where("id", $request->id)->first();
      $article->status = 0;
      $article->save();
    }

    return response()->json([
        "status" => 200,
        "message" => "Save draft article Successfully!"
    ]);
  }

  public function setRoleEdit (Request $request) {
    $article = Article::where("id", $request->id)->first();
    $article->user_role_edit_id = $request->user_role_edit_id;
    $article->user_role_edit_name = $request->user_role_edit_name;
    $article->save();
    return response()->json([
      "status" => 200,
      "message" => "Chỉ định quyền sửa bài viết thành công!"
    ]);
  }
}
