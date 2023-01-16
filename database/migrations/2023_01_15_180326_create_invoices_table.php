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
            $table->id();
            $table->string("reference_no");
            $table->bigInteger("sender_id");
            $table->string("recipient_name");
            $table->string("recipient_address");
            $table->double("sub_total");
            $table->float("tax_rate");
            $table->double("tax_amount");
            $table->double("total");
            $table->double("amount_paid");
            $table->double("amount_due");
            $table->string("notes");
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
        Schema::dropIfExists('invoices');
    }
}
