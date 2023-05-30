<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->string('option_name');
            $table->text('description')->nullable();
            $table->text('ingredients')->nullable();;
            $table->string('shift');
            $table->float('price');
            $table->foreignId('id_category')
                ->constrained('categories')
                ->cascadeOnUpdate();
            $table->string('optioImage_url')->nullable();
            $table->timestamps();
        });
    }

    /** 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
