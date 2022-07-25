<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();           
            $table->unsignedBigInteger('user_id');
            $table->string('cover_id');
            $table->string('paystack_ref');
            $table->double('amount');
            $table->boolean('confirmed')->default(false);
            $table->text('description')->nullable();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('transactions');
    }
}
