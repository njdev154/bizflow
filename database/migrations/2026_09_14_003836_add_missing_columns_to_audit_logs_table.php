<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('audit_logs', function (Blueprint $table) {
            if (! Schema::hasColumn('audit_logs', 'organization_id')) {
                $table->foreignId('organization_id')->nullable()->after('id')->constrained()->nullOnDelete();
            }

            if (! Schema::hasColumn('audit_logs', 'user_id')) {
                $table->foreignId('user_id')->nullable()->after('organization_id')->constrained()->nullOnDelete();
            }

            if (! Schema::hasColumn('audit_logs', 'action')) {
                $table->string('action')->after('user_id');
            }

            if (! Schema::hasColumn('audit_logs', 'auditable_type')) {
                $table->string('auditable_type')->nullable()->after('action');
            }

            if (! Schema::hasColumn('audit_logs', 'auditable_id')) {
                $table->unsignedBigInteger('auditable_id')->nullable()->after('auditable_type');
            }

            if (! Schema::hasColumn('audit_logs', 'meta')) {
                $table->json('meta')->nullable()->after('auditable_id');
            }
        });

        if (! Schema::hasColumn('audit_logs', 'created_at')) {
            Schema::table('audit_logs', function (Blueprint $table) {
                $table->timestamp('created_at')->useCurrent();
            });
        }

        if (! Schema::getConnection()->getSchemaBuilder()->getIndexListing('audit_logs', 'audit_logs_organization_id_created_at_index')) {
            Schema::table('audit_logs', function (Blueprint $table) {
                $table->index(['organization_id', 'created_at']);
            });
        }
    }

    public function down(): void
    {
        Schema::table('audit_logs', function (Blueprint $table) {
            $columns = ['organization_id', 'user_id', 'action', 'auditable_type', 'auditable_id', 'meta'];

            foreach ($columns as $column) {
                if (Schema::hasColumn('audit_logs', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
