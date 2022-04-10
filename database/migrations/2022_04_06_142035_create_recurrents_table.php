<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecurrentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recurrents', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();

            $table->dateTimeTz('date_recurrent')->nullable();

            $table->bigInteger('subscription_id')->unsigned()->nullable(); 
            $table->foreign('subscription_id')->references('id')->on('subscriptions');

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
        Schema::dropIfExists('recurrents');
    }
}
