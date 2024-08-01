<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('loop_subscriber_id');
            $table->bigInteger('shopify_id');
            $table->string('customer_email_address');
            $table->string('customer_billing_address')->nullable();
            $table->string('customer_shipping_address')->nullable();
            $table->bigInteger('all_order_ids');
            $table->string('join_date')->nullable();
            $table->string('next_billing_date')->nullable();
            $table->string('subscription_status');
            $table->string('unique_customer_number')->nullable();
            $table->string('last_golden_ticket')->nullable();
            $table->string('customer_notes')->nullable();
            $table->string('type')->default(0)->nullable();
            $table->string('status')->default(0)->nullable();
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
        Schema::dropIfExists('manage_data');
    }
}
