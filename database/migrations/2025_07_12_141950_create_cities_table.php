<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration {

	public function up()
	{
		Schema::create('cities', function(Blueprint $table) {
			$table->id();
			$table->string('name', 255);
			$table->foreignId('governorate_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('cities');
	}
}