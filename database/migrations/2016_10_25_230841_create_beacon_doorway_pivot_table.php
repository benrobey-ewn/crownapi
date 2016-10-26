<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeaconDoorwayPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beacon_doorway', function (Blueprint $table) {
            $table->integer('beacon_id')->unsigned()->index();
            $table->foreign('beacon_id')->references('id')->on('beacons')->onDelete('cascade');
            $table->integer('doorway_id')->unsigned()->index();
            $table->enum('type', ['inner', 'outer', 'through']);
            $table->foreign('doorway_id')->references('id')->on('doorways')->onDelete('cascade');
            $table->primary(['beacon_id', 'doorway_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('beacon_doorway');
    }
}
