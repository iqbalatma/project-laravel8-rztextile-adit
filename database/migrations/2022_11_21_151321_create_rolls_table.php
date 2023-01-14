<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rolls', function (Blueprint $table) {
            $table->id();
            $table->string("code", 64);
            $table->string("name", 128);
            $table->integer("quantity_roll");
            $table->integer("quantity_unit");
            $table->string("barcode", 64);
            $table->float("basic_price")->default(0);
            $table->float("selling_price")->default(0);
            $table->string("barcode_image", 256)->nullable();
            $table->unsignedBigInteger("unit_id")->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('rolls');
    }
}
