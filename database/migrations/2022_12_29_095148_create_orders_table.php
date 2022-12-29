<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type');
            $table->tinyInteger('stockist');
            $table->string('reference');
            $table->unsignedBigInteger('user_id');
            $table->decimal('price',65,18);
            $table->decimal('points_value',65,18);
            $table->decimal('pool_share',65,18);
            $table->string('full_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('barangay')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('terminal_user_id')->default(0);
            $table->dateTime('date_time_completed')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
