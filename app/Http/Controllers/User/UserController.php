<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
  public function getListUser () {
    $users = User::all();
    return response()->json([
      "data" => $users,
      "status" => 200,
      "message" => "Lấy danh sách user thành công!"
    ]);
  }

  public function changeRole (Request $request) {
    $user = User::where('id', $request->id)->first();
    $user->role = $request->role;
    $user->save();
    return response()->json([
      "status" => 200,
      "message" => "Cập nhật quyền thành công!"
    ]);
  }
}
