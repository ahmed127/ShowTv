<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('gifts', function (Blueprint $table) {

            // Columns
            $table->id();
            // $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('amount');
            $table->timestamp('expired_at');

            // Foreign Key Constraints

            if (Schema::hasTable('users')) {
                $table->foreignId('user_id')->constrained('users');
            }else{
                $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('gifts');
    }
}
