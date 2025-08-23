<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('personal_access_tokens', 'fcm_token')) {
            Schema::table('personal_access_tokens', function (Blueprint $table) {
                $table->string('fcm_token')->nullable()->after('abilities')->comment('Firebase Cloud Messaging Token');
                $table->index('fcm_token', 'idx_personal_access_tokens_fcm_token');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            $table->dropIndex('idx_personal_access_tokens_fcm_token');
            $table->dropColumn('fcm_token');
        });
    }
};
