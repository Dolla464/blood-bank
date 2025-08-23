<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration
{

	public function up()
	{
		Schema::table('clients', function (Blueprint $table) {
			$table->foreign('blood_type_id')->references('id')->on('blood_types')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('city_id')->references('id')->on('cities')->onDelete('restrict')->onUpdate('restrict');
		});

		Schema::table('cities', function (Blueprint $table) {
			$table->foreign('governorate_id')->references('id')->on('governorates')->onDelete('restrict')->onUpdate('restrict');
		});

		Schema::table('posts', function (Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict')->onUpdate('restrict');
		});

		Schema::table('client_post', function (Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('post_id')->references('id')->on('posts')->onDelete('restrict')->onUpdate('restrict');
		});

		Schema::table('donation_requests', function (Blueprint $table) {
			$table->foreign('blood_type_id')->references('id')->on('blood_types')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('city_id')->references('id')->on('cities')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('client_id')->references('id')->on('clients')->onDelete('restrict')->onUpdate('restrict');
		});

		Schema::table('contact_us', function (Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')->onDelete('restrict')->onUpdate('restrict');
		});

		Schema::table('notifications', function (Blueprint $table) {
			$table->foreign('donation_request_id')->references('id')->on('donation_requests')->onDelete('restrict')->onUpdate('restrict');
		});

		Schema::table('client_notification', function (Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('notification_id')->references('id')->on('notifications')->onDelete('restrict')->onUpdate('restrict');
		});

		Schema::table('blood_type_client', function (Blueprint $table) {
			$table->foreign('blood_type_id')->references('id')->on('blood_types')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('client_id')->references('id')->on('clients')->onDelete('restrict')->onUpdate('restrict');
		});

		Schema::table('client_governorate', function (Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('governorate_id')->references('id')->on('governorates')->onDelete('restrict')->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('clients', function (Blueprint $table) {
			$table->dropForeign(['blood_type_id']);
			$table->dropForeign(['city_id']);
		});

		Schema::table('cities', function (Blueprint $table) {
			$table->dropForeign(['governorate_id']);
		});

		Schema::table('posts', function (Blueprint $table) {
			$table->dropForeign(['category_id']);
		});

		Schema::table('client_post', function (Blueprint $table) {
			$table->dropForeign(['client_id']);
			$table->dropForeign(['post_id']);
		});

		Schema::table('donation_requests', function (Blueprint $table) {
			$table->dropForeign(['blood_type_id']);
			$table->dropForeign(['city_id']);
			$table->dropForeign(['client_id']);
		});

		Schema::table('contact_us', function (Blueprint $table) {
			$table->dropForeign(['client_id']);
		});

		Schema::table('notifications', function (Blueprint $table) {
			$table->dropForeign(['donation_request_id']);
		});

		Schema::table('client_notification', function (Blueprint $table) {
			$table->dropForeign(['client_id']);
			$table->dropForeign(['notification_id']);
		});

		Schema::table('blood_type_client', function (Blueprint $table) {
			$table->dropForeign(['blood_type_id']);
			$table->dropForeign(['client_id']);
		});

		Schema::table('client_governorate', function (Blueprint $table) {
			$table->dropForeign(['client_id']);
			$table->dropForeign(['governorate_id']);
		});
	}
}
