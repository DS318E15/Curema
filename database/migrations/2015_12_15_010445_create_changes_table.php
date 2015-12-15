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
            $table->string('user_id')->nullable();
            $table->string('account_id')->nullable();
            $table->string('contact_id')->nullable();
            $table->string('opportunity_id')->nullable();
            $table->string('lead_id')->nullable();
            $table->string('case_id')->nullable();
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
