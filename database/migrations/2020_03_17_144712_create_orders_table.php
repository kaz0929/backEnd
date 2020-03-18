<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('user_id')->default(0);
			$table->string('recipient_name')->default('0');
			$table->string('recipient_phone')->default('0');
			$table->string('recipient_address')->default('0');
            $table->string('shipment_time')->default('0');
            $table->integer('shipment_price')->default(0);
			$table->integer('total_price')->default(0);
			$table->string('shipment_status', 50)->default('0');
			$table->string('payment_status', 50)->default('0');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}

}
