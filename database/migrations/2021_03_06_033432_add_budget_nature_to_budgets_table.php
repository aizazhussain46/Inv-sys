<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBudgetNatureToBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('budgetitems', function (Blueprint $table) {
            $table->string('budget_nature')->after('total_price_pkr')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('budgetitems', function (Blueprint $table) {
            $table->dropColumn('budget_nature');
        });
    }
}
