<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->id();
			$table->string('name', 255);
            $table->string('phone', 11)->unique();
            $table->string('password', 255);
            $table->string('email', 255)->unique();
            $table->date('date_of_birth');
            $table->foreignId('blood_type_id');
            $table->foreignId('city_id');
            $table->date('last_donation_date')->nullable();
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
