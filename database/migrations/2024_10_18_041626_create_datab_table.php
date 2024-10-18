<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('datab', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('nama_produk');
            $table->integer('qty');
            $table->string('uom');
            $table->string('attribute')->unique();
            $table->string('storage_bin');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datab');
    }
};
