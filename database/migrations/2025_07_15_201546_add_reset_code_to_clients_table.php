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
        Schema::table('clients', function (Blueprint $table) {
            $table->string('reset_code')->nullable();
            $table->timestamp('reset_code_expires_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
            Schema::table('clients', function (Blueprint $table) {
                $table->dropColumn(['reset_code', 'reset_code_expires_at']);
        });
    }
};
