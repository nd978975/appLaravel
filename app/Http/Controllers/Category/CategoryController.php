<?php
namespace App\Http\Controllers\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
  public function create (Request $request) {
    Category::create([
      'name' => $request->name,
      'slug' => $request->slug,
      'description' => $request->description,
      'user_id' => $request->user_id,
      'user_name' => $request->user_name,
      'title_seo' => $request->name,
      'description_seo' => $request->description,
      'status' => $request->status,
    ]);
    return response()->json([
      "status" => 200,
      "message" => "Create Category Successfully!"
    ]);
  }
  public function edit (Request $request) {
    $id = (int)($request->id);
    $category = Category::where("id", $id)->first();
    $category->name = $request->name;
    $category->slug = $request->slug;
    $category->description = $request->description;
    $category->title_seo = $request->name;
    $category->description_seo = $request->description;
    $category->status = $request->status;
    $category->save();
    return response()->json([
      "status" => "Success",
      "message" => "Sửa danh mục thành công!"
    ]);
  }
  public function list () {
    $categories = Category::withTrashed()->get();
    return response()->json([
      "categories" => $categories
    ], 200);
  }
  public function detailByID (Request $request, $id) {
    $category = Category::where('id', $id)->first();
    return response()->json([
      "data" => $category,
      "status" => 200,
      "message" => "Lấy ra chi tiết danh mục!"
    ]);
  }
  public function detailBySlug (Request $request, $slug) {
    $category = Category::where('slug', $slug)->first();
    return response()->json([
      "data" => $category,
      "status" => 200,
      "message" => "Lấy ra chi tiết danh mục!"
    ]);
  }
  public function listTrash () {
    $categories = Category::onlyTrashed()->get();
    return response()->json([
      "data" => $categories,
      "status" => "Success",
      "message" => "Lấy danh sách danh mục trong thùng rác!"
    ]);
  }
  public function publicItem (Request $request) {
    if(is_array($request->id)) {
      foreach ($request->id as $key => $id) {
        $category = Category::where("id", $id)->first();
        $category->status = 1;
        $category->save();
      }
    }else {
      $category = Category::where("id", $request->id)->first();
      $category->status = 1;
      $category->save();
    }

    return response()->json([
      "status" => 200,
      "message" => "Đăng công khai danh mục thành công!"
    ]);
  }
  public function moveToDraft (Request $request) {
    if(is_array($request->id)) {
      foreach ($request->id as $key => $id) {
        $category = Category::where("id", $id)->first();
        $category->status = 0;
        $category->save();
      }
    }else {
      $category = Category::where("id", $request->id)->first();
      $category->status = 0;
      $category->save();
    }
   
    return response()->json([
      "status" => 200,
      "message" => "Lưu nháp danh mục thành công!"
    ]);
  }
  public function moveToTrash (Request $request) {
    if(is_array($request->id)) {
      foreach ($request->id as $key => $id) {
        $category = Category::where("id", $id)->first();
        $category->delete();
      }
    }else {
      $category = Category::where("id", $request->id)->first();
      $category->delete();
    }

    return response()->json([
      "status" => "Success",
      "message" => "Đã chuyển danh mục vào thùng rác!"
    ]);
  }
  public function restore (Request $request) {
    if(is_array($request->id)) {
      foreach ($request->id as $id) {
        $category = Category::withTrashed()
        ->where("id", $id)->first();
        $category->restore();
      }
    }else {
      $category = Category::withTrashed()
      ->where("id", $request->id)->first();
      $category->restore();
    }

    return response()->json([
      "status" => 200,
      "message" => "Khôi phục danh mục thành công!"
    ]);
  }
  public function delete (Request $request) {
    if(is_array($request->id)) {
      foreach ($request->id as $key => $id) {
        $category = Category::where("id", $id)->first();
        $category->forceDelete();
      }
    }else {
      $category = Category::where("id", $request->id)->first();
      $category->forceDelete();
    }

    return response()->json([
      "status" => 200,
      "message" => "Xóa danh mục thành công!"
    ]);
  }
  public function setRoleEdit (Request $request) {
    $category = Category::where("id", $request->id)->first();
    $category->user_role_edit_id = $request->user_role_edit_id;
    $category->user_role_edit_name = $request->user_role_edit_name;
    $category->save();
    return response()->json([
      "status" => 200,
      "message" => "Chỉ định quyền sửa bài viết thành công!"
    ]);
  }
}