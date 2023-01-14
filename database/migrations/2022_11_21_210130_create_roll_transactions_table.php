<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRollTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roll_transactions', function (Blueprint $table) {
            $table->id();
            $table->enum("type",["restock", "sold", "broken"]);
            $table->integer("quantity_roll");
            $table->integer("quantity_unit");
            $table->float("capital")->nullable();
            $table->float("profit")->nullable();
            $table->unsignedBigInteger("roll_id")->nullable();
            $table->unsignedBigInteger("invoice_id")->nullable();
            $table->unsignedBigInteger("user_id")->nullable();
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
        Schema::dropIfExists('roll_transactions');
    }
}
