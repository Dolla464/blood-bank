<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGovernoratesTable extends Migration {

	public function up()
	{
		Schema::create('governorates', function(Blueprint $table) {
			$table->id();
			$table->string('name', 255);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('governorates');
	}
}
