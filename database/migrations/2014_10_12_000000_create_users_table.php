<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('contact_number');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('pin_code')->default("0000");
            $table->string('referral_code');
            $table->unsignedBigInteger('package_id')->default(0);;
            $table->unsignedBigInteger('sponsor')->default(1);
            $table->tinyInteger('rank')->default(0);
            $table->tinyInteger('stockist')->default(0);
            $table->string('photo')->nullable();
            $table->tinyInteger('role')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
