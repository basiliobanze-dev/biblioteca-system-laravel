<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
           $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->dateTime('loan_date'); // Loan date
            $table->dateTime('due_date'); // Prev return date
            $table->dateTime('return_date')->nullable(); // real return date
            $table->string('protocol')->unique();  // unique loan code
            $table->decimal('fine_amount', 8, 2)->default(0); // fine
            $table->enum('status', ['active', 'returned', 'pending'])->default('active');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
