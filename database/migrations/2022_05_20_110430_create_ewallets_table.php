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
            $table->id('count');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('id')->nullable();
            $table->string('reference_id')->nullable();
            $table->string('payment_channel')->nullable();
            $table->string('channel_code')->nullable();
            $table->string('amount')->nullable();
            $table->string('status')->nullable();
            $table->string('pay_at')->nullable();
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
