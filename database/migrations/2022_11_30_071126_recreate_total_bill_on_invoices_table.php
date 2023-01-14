<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateTotalBillOnInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("invoices", function (Blueprint $table){
            $table->dropColumn("total_bill");
        });

        Schema::table("invoices", function (Blueprint $table){
            $table->float("total_bill")->default(0)->after("total_capital");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
