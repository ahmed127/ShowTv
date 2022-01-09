<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            // Columns
            $table->id();
            // $table->unsignedBigInteger('show_id');
            // $table->unsignedBigInteger('user_id');

            // Foreign Key Constraints

            if (Schema::hasTable('users')) {
                $table->foreignId('user_id')->constrained('users');
            }else{
                $table->unsignedBigInteger('user_id');
            }

            if (Schema::hasTable('shows')) {
                $table->foreignId('show_id')->constrained('shows');
            }else{
                $table->unsignedBigInteger('show_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
