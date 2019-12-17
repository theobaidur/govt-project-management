<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('system_invoice_no')->nullable();
            $table->string('billing_invoice_no')->nullable();
            $table->string('invoice_type')->nullable();
            $table->float('amount')->default(0);
            $table->float('cash')->default(0);
            $table->float('tax')->default(0);
            $table->float('security_money')->default(0);
            $table->text('note')->nullable();
            $table->unsignedBigInteger('billing_account_id')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->timestamps();

            $table->foreign('billing_account_id')->references('id')->on('billing_accounts')->onDelete('SET NULL');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
