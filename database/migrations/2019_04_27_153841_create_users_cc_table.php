<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersCcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_cc', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cc_type');
            $table->double('statement_amount', 8, 2);
            $table->double('outstanding_amount', 8, 2);
            $table->double('interest', 8, 2);
            $table->bigInteger('due_date');
            $table->double('credit_limit', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_cc');
    }
}
