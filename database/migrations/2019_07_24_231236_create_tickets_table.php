<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('tickets', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name', 128);
			$table->tinyInteger('priority', false, true);
			$table->integer('client', false, true);
			$table->longText('details');
			$table->tinyInteger('status', false, true);
			$table->timestamps();
			//$table->foreign('client')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('tickets');
	}
}
