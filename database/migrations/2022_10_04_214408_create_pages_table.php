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
        //`name`, `description`, `slug`
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('resource')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('photo');
            $table->string('meta_description')->nullable();
            $table->mediumText('description')->nullable();
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('pages');
    }
};
