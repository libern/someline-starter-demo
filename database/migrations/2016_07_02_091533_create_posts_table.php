<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table) {
			$table->increments('post_id');
			$table->unsignedInteger('user_id')->index();

			// custom fields
			$table->string('title');
			$table->text('body');
			$table->boolean('is_recommended')->default(false);

			$table->unsignedInteger('created_by')->nullable();
			$table->timestamp('created_at')->nullable();
			$table->ipAddress('created_ip')->nullable();
			$table->unsignedInteger('updated_by')->nullable();
			$table->timestamp('updated_at')->nullable();
			$table->ipAddress('updated_ip')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posts');
	}

}
