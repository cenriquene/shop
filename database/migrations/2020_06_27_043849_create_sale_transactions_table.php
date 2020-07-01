<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_transactions', function (Blueprint $table) {
            $table->id();
            $table->float('subtotal')->default(0);
            $table->float('total')->default(0);
            $table->enum('currency', ['MXN', 'USD'])->default('USD');
            $table->string('name', 100)->nullable(FALSE);
            $table->string('address', 200)->nullable(FALSE);
            $table->string('country', 150)->nullable(FALSE);
            $table->integer('exp_month')->nullable(FALSE);
            $table->integer('exp_year')->nullable(FALSE);
            $table->integer('card_last_numbers')->nullable(FALSE);
            $table->json('gateway_response')->nullable();
            $table->bigInteger('sale_id')->unsigned()->index()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_transactions');
    }
}
