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
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->mediumText('description')->nullable();
            $table->integer('status')->default(0);
            $table->integer('user_id')->default(1);
            $table->string('user_name')->default('Admin');
            $table->integer('user_role_edit_id')->nullable();
            $table->string('user_role_edit_name')->nullable();
            $table->string('img')->nullable();
            $table->string('title_seo')->nullable();
            $table->mediumText('description_seo')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
