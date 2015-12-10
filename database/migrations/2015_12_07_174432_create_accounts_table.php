<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');
            $table->string('name');
            $table->string('street_name');
            $table->string('street_number');
            $table->string('city');
            $table->string('zip');
            $table->string('country');
            $table->integer('cvr');
            $table->string('phone');
            $table->string('email');
            $table->string('website');

            $table->boolean('active')->default(1);
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
        Schema::drop('accounts');
    }
}
