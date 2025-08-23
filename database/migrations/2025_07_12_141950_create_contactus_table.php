<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactusTable extends Migration {

	public function up()
	{
		Schema::create('contact_us', function(Blueprint $table) {
			$table->id();
			$table->string('subject', 255);
			$table->text('message');
			$table->foreignId('client_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('contact_us');
	}
}