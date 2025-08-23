<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration {

	public function up()
	{
		Schema::create('posts', function(Blueprint $table) {
			$table->id();
			$table->string('title', 255);
			$table->mediumText('content');
			$table->string('photo');
			$table->foreignId('category_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('posts');
	}
}