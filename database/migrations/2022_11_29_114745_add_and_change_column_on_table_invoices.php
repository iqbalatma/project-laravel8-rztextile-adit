<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAndChangeColumnOnTableInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("invoices", function (Blueprint $table){
            $table->dropColumn("payment_type");
            $table->renameColumn("total_payment", "total_bill");
            $table->float("total_paid_amount")->default(0)->after("total_profit");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("invoices", function (Blueprint $table){
            $table->enum("payment_type", ["cash", "transfer"])->nullable();
            $table->renameColumn("total_bill", "total_payment");
            $table->dropColumn("total_paid_amount");
        });
    }
}
