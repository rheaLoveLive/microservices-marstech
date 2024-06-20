<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('no_trans', 20);
            $table->date('tgl_trans');
            $table->smallInteger('id_addon');
            $table->smallInteger('id_user');
            $table->integer('gtotal_trans');
            $table->integer('diskon_trans')->default(0);
            $table->integer('pay_trans');
            $table->string('type_payment_trans', 20);
            $table->string('payment_with_trans', 50)->nullable();
            $table->string('number_card_trans', 50)->nullable();
            $table->smallInteger('status_trans')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
