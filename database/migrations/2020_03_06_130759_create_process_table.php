<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('type')->default(1)->comment('1:Process, 2:Resource, 3:Task');
            $table->string('code')->nullable();
            $table->string('description')->nullable();
            $table->bigInteger('i_by')->nullable();
            $table->bigInteger('i_date')->nullable();
            $table->bigInteger('u_by')->nullable();
            $table->bigInteger('u_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('process');
    }
}
