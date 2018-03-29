<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDashboardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_dashboard', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_area', 20);
            $table->string('nama_area', 50);
            $table->string('leader', 50);
            $table->string('supervisor', 50);
            $table->string('manager', 50);
            $table->string('auditor', 50);
            $table->integer('hitung_8');
            $table->integer('hitung_9');
            $table->integer('hitung_10');
            $table->integer('entry_9');
            $table->integer('entry_10');
            $table->integer('entry_11');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('m_dashboard');
    }
}
