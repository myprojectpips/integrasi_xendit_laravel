<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tb_ewallet', function (Blueprint $table) {
            $table->integer('count');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('id');
            $table->string('reference_id');
            $table->string('payment_channel');
            $table->string('channel_code');
            $table->string('amount');
            $table->string('status');
            $table->string('pay_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('tb_ewallet');
    }
};
