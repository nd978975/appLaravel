<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->longText('content')->nullable();
            $table->integer('status')->default(0);
            $table->string('img')->nullable();
            $table->unsignedBigInteger('user_id')->default(1);
            $table->integer('category_id')->nullable();
            $table->string('category_name')->nullable();
            $table->integer('user_role_edit_id')->nullable();
            $table->string('user_role_edit_name')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('user_name');
            $table->string('title_seo')->nullable();
            $table->mediumText('description_seo')->nullable();
            $table->string('tags')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
