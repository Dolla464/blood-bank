<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameHospitalNameToHospitalAddressInDonationRequestsTable extends Migration
{
    public function up(): void
    {
        Schema::table('donation_requests', function (Blueprint $table) {
            $table->string('hospital_address')->after('bags_number');
        });

        // Copy existing data from hospital_name to hospital_address
        DB::statement('UPDATE donation_requests SET hospital_address = hospital_name');

        // Drop old column
        Schema::table('donation_requests', function (Blueprint $table) {
            $table->dropColumn('hospital_name');
        });
    }

    public function down(): void
    {
        Schema::table('donation_requests', function (Blueprint $table) {
            $table->string('hospital_name')->after('bags_number');
        });

        DB::statement('UPDATE donation_requests SET hospital_name = hospital_address');

        Schema::table('donation_requests', function (Blueprint $table) {
            $table->dropColumn('hospital_address');
        });
    }
}

