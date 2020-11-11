<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTypesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_writers', function (Blueprint $table) {
            $table->bigInteger('id')->unique();
            $table->boolean('quick_contact')->default(false);
            $table->boolean('quick_reply')->default(false);
            $table->timestamps();

            $table->foreign('id')->references('id')->on('users')->onDelete('CASCADE');
        });


        Schema::create('users_suppliers', function (Blueprint $table) {
            $table->bigInteger('id')->unique();
            $table->boolean('quick_notify')->default(false);
            $table->timestamps();

            $table->foreign('id')->references('id')->on('users')->onDelete('CASCADE');
        });

        Schema::create('users_admins', function (Blueprint $table) {
            $table->bigInteger('id')->unique();
            $table->boolean('low_sms_notification')->default(false);
            $table->timestamps();

            $table->foreign('id')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_writers');
        Schema::dropIfExists('users_suppliers');
        Schema::dropIfExists('users_admins');
    }
}
