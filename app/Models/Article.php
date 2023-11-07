<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'content',
        'status',
        'img',
        'user_id',
        'category_id',
        'category_name',
        'user_role_edit_id',
        'user_role_edit_name',
        'user_name',
        'title_seo',
        'description_seo',
        'tags',
    ];
}
