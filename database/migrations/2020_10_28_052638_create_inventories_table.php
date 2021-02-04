<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->nullable();
            $table->integer('subcategory_id')->nullable();
            $table->integer('location_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->integer('store_id')->nullable();
            $table->integer('model_id')->nullable();
            $table->integer('make_id')->nullable();
            $table->integer('vendor_id')->nullable();
            $table->string('devicetype_id')->nullable();
            $table->string('inventorytype_id')->nullable();
            $table->string('product_sn')->nullable();
            $table->string('purchase_date')->nullable();
            $table->string('itemnature_id')->nullable();
            $table->string('item_price')->nullable();
            $table->string('dollar_rate')->nullable();
            $table->string('remarks')->nullable();
            $table->string('delivery_challan')->nullable();
            $table->string('delivery_challan_date')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('invoice_date')->nullable();
            $table->string('other_accessories')->nullable();
            $table->string('purpose')->nullable();
            $table->string('good_condition')->nullable();
            $table->string('verification')->nullable();
            $table->integer('issued_to')->nullable();
            $table->integer('issued_by')->nullable();
            $table->string('status')->nullable();
            $table->string('po_number')->nullable();
            $table->string('warrenty_period')->nullable();
            $table->string('insurance')->nullable();
            $table->string('licence_key')->nullable();
            $table->string('sla')->nullable();
            $table->string('warrenty_check')->nullable();
            $table->string('operating_system')->nullable();
            $table->string('SAP_tag')->nullable();
            $table->string('capacity')->nullable();
            $table->string('hard_drive')->nullable();
            $table->string('processor')->nullable();
            $table->string('process_generation')->nullable();
            $table->string('display_type')->nullable();
            $table->string('DVD_rom')->nullable();
            $table->string('RAM')->nullable();

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
        Schema::dropIfExists('inventories');
    }
}
