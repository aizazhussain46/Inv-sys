<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResignedEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resigned_employees', function (Blueprint $table) {
            $table->id();
            $table->string('emp_code');
            $table->date('resign_date');
            $table->date('effective_from');
            $table->string('remarks', 500);
            $table->char('status', 1);
            $table->date('done_date');
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
        Schema::dropIfExists('resigned_employees');
    }
}
