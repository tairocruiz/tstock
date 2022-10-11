<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_post_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('post_id', false, true);
            $table->bigInteger('post_category_id', false, true);
            $table->foreign('post_category_id')->references('id')->on('post_categories')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('post_id')->references('id')->on('posts')->onUpdate('cascade')->onDelete('restrict');
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_post_categories');
    }
};
