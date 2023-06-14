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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->integer('guest_number');
            $table->dateTime('reservation_datetime');
            $table->string('reservation_status');
            $table->string('reference_name');
            $table->string('associated_event')->nullable();
            $table->text('extras')->nullable();
            $table->text('Cancel_reason')->nullable();
            $table->string('payment_status');
            $table->foreignId('id_package')
                ->nullable()
                ->constrained('packages')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('id_table')
                ->constrained('tables')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('id_user')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
