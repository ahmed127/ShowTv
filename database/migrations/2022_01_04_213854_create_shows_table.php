<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shows', function (Blueprint $table) {
            // Columns
            $table->id();
            $table->tinyInteger('type')->comment('1 => series, 2 => tv');
            $table->string('title');
            $table->longText('description');
            $table->unsignedInteger('price')->comment('Price can be 0 which means it is free');
            $table->boolean('status')->comment('Active Or Inactive');
            $table->timestamps();
        });

        Schema::create('show_times', function (Blueprint $table) {
            // Columns
            $table->id();

            $table->string('day')->comment('Monday, Tuesday, Wednesday, Thursday, Friday, Saturday, Sunday');
            $table->string('hour')->comment('24 hours from 12 AM to 11 PM');

            // Foreign Key Constraints
            if (Schema::hasTable('shows')) {
                $table->foreignId('show_id')->constrained('shows');
            }else{
                $table->unsignedBigInteger('show_id');
            }

        });

        Schema::create('show_followers', function (Blueprint $table) {
            // Columns
            $table->id();

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
        Schema::dropIfExists('show_followers');
        Schema::dropIfExists('show_times');
        Schema::dropIfExists('shows');
    }
}
