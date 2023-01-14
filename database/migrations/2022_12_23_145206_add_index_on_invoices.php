<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexOnInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("invoices", function (Blueprint $table) {
            $table->index(["customer_id", "created_at"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("invoices", function (Blueprint $table) {
            $table->dropIndex(["customer_id", "created_at"]);
        });
    }
}
