<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('audit_logs', function (Blueprint $table) {
            $table->foreignId('organization_id')->nullable()->after('id')->constrained()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->after('organization_id')->constrained()->nullOnDelete();
            $table->string('action')->after('user_id');
            $table->string('auditable_type')->nullable()->after('action');
            $table->unsignedBigInteger('auditable_id')->nullable()->after('auditable_type');
            $table->json('meta')->nullable()->after('auditable_id');

            $table->index(['organization_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::table('audit_logs', function (Blueprint $table) {
            $table->dropColumn(['organization_id', 'user_id', 'action', 'auditable_type', 'auditable_id', 'meta']);
        });
    }
};
