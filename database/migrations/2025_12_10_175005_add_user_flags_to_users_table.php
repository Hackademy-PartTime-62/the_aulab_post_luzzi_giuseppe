<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'is_admin')) {
                $table->boolean('is_admin')->default(false);
            }

            if (!Schema::hasColumn('users', 'is_revisor')) {
                $table->boolean('is_revisor')->default(false);
            }

            if (!Schema::hasColumn('users', 'is_revisor_request')) {
                $table->boolean('is_revisor_request')->default(false);
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_admin', 'is_revisor', 'is_revisor_request']);
        });
    }
};
