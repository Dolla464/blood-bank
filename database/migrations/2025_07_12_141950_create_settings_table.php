<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->id();
			$table->string('phone');
			$table->string('email');
			$table->string('fb_url');
			$table->string('x_url');
			$table->string('insta_url');
			$table->string('youtube_url');
			$table->text('about_app');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}