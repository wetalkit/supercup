<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableListingsAddStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->boolean('status')->after('user_id')->default(0);
            $table->integer('booker_id')->unsigned()->nullable()->after('status');
            $table->foreign('booker_id')->references('id')->on('users');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropForeign('listings_booker_id_foreign');
            $table->dropColumn('booker_id');
            $table->dropSoftDeletes();
        });
    }
}
