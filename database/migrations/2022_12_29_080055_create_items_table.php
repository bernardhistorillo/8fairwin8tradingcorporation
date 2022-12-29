<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type');
            $table->tinyInteger('package_id');
            $table->string('name');
            $table->decimal('center_price',65,18);
            $table->decimal('mobile_price',65,18);
            $table->decimal('distributors_price',65,18);
            $table->decimal('suggested_retail_price',65,18);
            $table->decimal('points_value',65,18);
            $table->decimal('points_level_1',65,18);
            $table->decimal('points_level_2',65,18);
            $table->decimal('points_level_3',65,18);
            $table->decimal('points_level_4',65,18);
            $table->decimal('points_level_5',65,18);
            $table->decimal('points_level_6',65,18);
            $table->decimal('points_level_7',65,18);
            $table->decimal('points_level_8',65,18);
            $table->string('photo')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('items');
    }
}
