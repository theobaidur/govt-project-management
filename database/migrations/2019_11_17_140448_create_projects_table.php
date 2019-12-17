<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->float('amount')->default(0);
            $table->float('bank_guarantee_amount')->default(0);
            $table->timestamp('start_date')->useCurrent = true;
            $table->timestamp('end_date')->useCurrent = true;
            $table->timestamps();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('project_client_id')->nullable();
            $table->unsignedInteger('project_director_id')->nullable();

            $table->foreign('department_id')->references('id')->on('departments')->onDelete('SET NULL');
            $table->foreign('project_client_id')->references('id')->on('project_clients')->onDelete('SET NULL');
            $table->foreign('project_director_id')->references('id')->on('admin_users')->onDelete('SET NULL');
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
        Schema::dropIfExists('projects');
    }
}
