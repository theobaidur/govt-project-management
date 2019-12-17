<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('stock_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->default('load'); // load / unload 
            $table->float('quantity')->default(0);
            $table->string('unit_name')->nullable();
            $table->decimal('unit_price')->default(0);
            $table->unsignedBigInteger('stock_id')->nullable();
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->timestamps();

            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('SET NULL');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('SET NULL');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('SET NULL');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_entries');
    }
}
