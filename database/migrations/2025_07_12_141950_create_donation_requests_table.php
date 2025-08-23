<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationRequestsTable extends Migration {

	public function up()
	{
		Schema::create('donation_requests', function(Blueprint $table) {
			$table->id();
			$table->string('patient_name', 255);
			$table->integer('patient_age');
			$table->foreignId('blood_type_id');
			$table->integer('bags_number');
			$table->string('hospital_name', 255);
			$table->decimal('latitude', 10,8);
			$table->decimal('longitude', 10,8);
			$table->foreignId('city_id');
			$table->foreignId('client_id');
			$table->string('patient_phone');
			$table->text('notes');
			$table->enum('status', ['pending', 'fulfilled', 'cancelled'])->default('pending');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('donation_requests');
	}
}