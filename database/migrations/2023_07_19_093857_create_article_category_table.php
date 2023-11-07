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
        Schema::create('article_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('article_id')->unsigned();
            $table->unsignedBigInteger('category_id')->unsigned();
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_category');
    }
};
