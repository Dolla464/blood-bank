<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodTypesTable extends Migration {

	public function up()
	{
		Schema::create('blood_types', function(Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('blood_types');
	}
}