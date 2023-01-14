<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string("code",64);
            $table->float("total_capital")->default(0);
            $table->float("total_payment")->default(0);
            $table->float("total_profit")->default(0);
            $table->enum("payment_type", ["cash", "transfer"])->nullable();
            $table->boolean("is_paid_off")->default(0);
            $table->unsignedBigInteger("customer_id")->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
