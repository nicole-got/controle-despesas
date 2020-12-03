<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
	public function up()
	{
		Schema::create('expenses', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsined();
			$table->string('description', 250);
			$table->date('date');
			$table->string('image',250);
			$table->decimal('value',5,2);

			$table->timestamps();
			$table->softDeletes();
			
			$table->foreign('user_id')->references('id')->on('users');
		});
	}

	public function down()
	{
		Schema::drop('expenses');
	}
}
