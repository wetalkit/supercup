<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableListings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->string('address');
            $table->string('lat', 20);
            $table->string('lng', 20);
            $table->integer('distance_stadium');
            $table->integer('distance_stadium_time');
            $table->integer('no_people');
            $table->integer('no_beds');
            $table->date('date_from');
            $table->date('date_to');
            $table->boolean('terms_accepted');
            $table->string('contact_email');
            $table->text('motiv')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('listings');
    }
}
