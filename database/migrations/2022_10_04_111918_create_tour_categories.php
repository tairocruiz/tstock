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
        //`name`, `special`, `seo_title`, `photo`, `slug`, `meta_description`, `description`,
        Schema::create('tour_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('special', false, true)->default(1);
            $table->string('seo_title');
            $table->string('photo');
            $table->string('slug')->nullable();
            $table->text('meta_description');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('tour_categories');
    }
};
