<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientNotificationTable extends Migration {

	public function up()
	{
		Schema::create('client_notification', function(Blueprint $table) {
			$table->id();
			$table->foreignId('client_id');
			$table->foreignId('notification_id');
			$table->boolean('is_read')->default(false);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('client_notification');
	}
}