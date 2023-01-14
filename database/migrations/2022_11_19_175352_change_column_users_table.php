<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')
                ->nullable()
                ->change();
            $table->string('password')
                ->nullable()
                ->change();
            $table->string("address", 255)
                ->nullable()
                ->after("password");
            $table->string("id_number",32)
                ->nullable()
                ->after("id");
            $table->string("phone",32)
                ->nullable()
                ->after("address");
            $table->unsignedBigInteger("role_id")
                ->nullable()
                ->after("remember_token");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn("phone");
            $table->dropColumn("role_id");
            $table->dropColumn("id_number");
            $table->dropColumn("address");
        });
    }
}
