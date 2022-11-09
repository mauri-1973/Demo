<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->uuid('uuid')->unique()->index();
            $table->date('payment_date')->nullable()->default(null);
            $table->date('expires_at');
            $table->string('status'); 
            $table->unsignedInteger('client_id');
            $table->integer('clp_usd')->length(11)->nullable()->default(null);
            $table->float('usd_clp', 11, 2)->nullable()->default(null);
            $table->softDeletes();
            $table->foreign('client_id')->references('id')->on('client')->onDelete('cascade');
            $table->timestamps();
            $table->primary('uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment');
    }
}
