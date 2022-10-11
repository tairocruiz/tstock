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
        // `name`, `slug`, `seo_title`, `meta_description`, `photo`, `price`, `days`, `tour_category_id`
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('meta_description');
            $table->string('photo');
            $table->double('price', 10, 2, true);
            $table->integer('days', false, true);
            $table->bigInteger('tour_category_id', false, true);
            $table->timestampsTz();

            $table->foreign('tour_category_id')->references('id')->on('tour_categories');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tours');
    }
};
