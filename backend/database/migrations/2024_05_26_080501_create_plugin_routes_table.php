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
        Schema::create('plugin_routes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20);
            $table->smallInteger('id_addon')->default(0);
            $table->string('path', 60);
            $table->string('icon', 40)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plugin_routes');
    }
};
