<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->dateTime('scheduled_at');
            $table->unsignedInteger('duration_minutes');
            $table->enum('status', ['planifie', 'confirme', 'en_attente', 'termine', 'annule', 'absent'])
                  ->default('planifie');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['organization_id', 'scheduled_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};