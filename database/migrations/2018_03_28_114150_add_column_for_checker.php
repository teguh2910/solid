<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnForChecker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_transactions', function (Blueprint $table) {
            //
            $table->integer('amount_box_checker')->after('total_pcs')->default(0);
            $table->integer('amount_pcs_checker')->after('amount_box_checker')->default(0);
            $table->integer('total_pcs_checker')->after('amount_pcs_checker')->default(0);
            $table->string('operator','40')->after('total_amount')->nullable();
            $table->string('checker','40')->after('operator')->nullable();
            // $table->integer('total_amount')->after('unit');
        });
        Schema::table('users', function (Blueprint $table) {
            //
            $table->integer('role_checker')->after('role')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('t_transactions', function (Blueprint $table) {
            $table->dropColumn('amount_box_checker');
            $table->dropColumn('amount_pcs_checker');
            $table->dropColumn('total_pcs_checker');
            $table->dropColumn('operator');
            $table->dropColumn('checker');
         });
         Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('role_checker');
        });
    }
}
