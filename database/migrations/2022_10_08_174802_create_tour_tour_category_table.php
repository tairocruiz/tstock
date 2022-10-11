<?php

use App\Models\Tour;
use App\Models\TourCategory;
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
        Schema::create('tour_tour_category', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tour::class)->constrained('tours');
            $table->foreignIdFor(TourCategory::class)->constrained('tour_categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tour_tour_category');
    }
};
