<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgetitems', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('subcategory_id')->nullable();
            $table->integer('type_id')->nullable();
            $table->integer('dept_id')->nullable();
            $table->string('department')->nullable();
            $table->integer('year_id')->nullable();
            $table->text('description')->nullable();
            $table->text('remarks')->nullable();
            $table->string('unit_price_dollar')->nullable();
            $table->string('unit_price_pkr')->nullable();
            $table->string('qty')->nullable();
            $table->string('consumed')->nullable();
            $table->string('remaining')->nullable();
            $table->string('total_price_dollar')->nullable();
            $table->string('total_price_pkr')->nullable();
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
        Schema::dropIfExists('budgetitems');
    }
}
