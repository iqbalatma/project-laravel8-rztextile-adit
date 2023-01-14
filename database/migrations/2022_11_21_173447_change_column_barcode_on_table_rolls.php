<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnBarcodeOnTableRolls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("rolls", function (Blueprint $table){
            $table->renameColumn("barcode", "qrcode");
            $table->renameColumn("barcode_image", "qrcode_image");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("rolls", function (Blueprint $table){
            $table->renameColumn("qrcode", "barcode");
            $table->renameColumn("qrcode_image", "barcode_image");
        });
    }
}
