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
            $table->text('id')->nullable();
            $table->string('external_id')->nullable();
            $table->string('payment_channel')->nullable();
            $table->string('nominal')->nullable();
            $table->string('status')->nullable();
            $table->string('qr_string')->nullable();
            $table->string('pay_at')->nullable();
            $table->string('receipt_id')->nullable();
            $table->string('source')->nullable();
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
