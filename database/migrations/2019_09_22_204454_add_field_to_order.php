<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('otw_order', function (Blueprint $table) {
            $table->integer('kota')->after('nohp')->nullable();
            $table->integer('ongkir')->after('alamat')->nullable();
            $table->string('paket')->after('ongkir')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('otw_order', function (Blueprint $table) {
            $table->dropColumn('kota');
            $table->dropColumn('ongkir');
            $table->dropColumn('paket');
        });
    }
}
