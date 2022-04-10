<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionRecurrentTriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_recurrent_tries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tries');

            $table->bigInteger('subscription_id')->unsigned()->nullable(); 
            $table->foreign('subscription_id')->references('id')->on('subscriptions');

            $table->bigInteger('recurrent_id')->unsigned()->nullable(); 
            $table->foreign('recurrent_id')->references('id')->on('recurrents');

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
        Schema::dropIfExists('subscription_recurrent_tries');
    }
}
