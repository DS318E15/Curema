<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('changes', function (Blueprint $table) {
            $table->increments('id');

            $table->string('type');
            $table->integer('user_id')->nullable();
            $table->integer('account_id')->nullable();
            $table->integer('contact_id')->nullable();
            $table->integer('opportunity_id')->nullable();
            $table->integer('lead_id')->nullable();
            $table->integer('ticket_id')->nullable();
            $table->integer('call_id')->nullable();
            $table->integer('email_id')->nullable();

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
        Schema::drop('changes');
    }
}
