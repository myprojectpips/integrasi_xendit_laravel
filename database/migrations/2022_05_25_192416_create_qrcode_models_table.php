<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_qrcode', function (Blueprint $table) {
            $table->id('count');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('id');
            $table->string('external_id');
            $table->string('payment_channel');
            $table->string('nominal');
            $table->string('status');
            $table->string('qr_string');
            $table->string('pay_at');
            $table->string('receipt_id');
            $table->string('source');
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
        Schema::dropIfExists('tb_qrcode');
    }
};
