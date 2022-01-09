<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            
            // Columns
            $table->id();
            $table->string('thumbnail');
            $table->string('title');
            $table->longText('description');
            $table->string('duration');
            $table->string('day')->comment('Monday, Tuesday, Wednesday, Thursday, Friday, Saturday, Sunday');
            $table->string('hour')->comment('24 hours from 12 AM to 11 PM');
            $table->string('video');
            $table->timestamps();

            // Foreign Key Constraints
            if (Schema::hasTable('shows')) {
                $table->foreignId('show_id')->constrained('shows');
            }else{
                $table->unsignedBigInteger('show_id');
            }
        });

        Schema::create('episode_rates', function (Blueprint $table) {
            // Columns
            $table->id();
            $table->tinyInteger('type')->comment('0 => Dislike, 1 => Like');

            // Foreign Key Constraints

            if (Schema::hasTable('users')) {
                $table->foreignId('user_id')->constrained('users');
            }else{
                $table->unsignedBigInteger('user_id');
            }

            if (Schema::hasTable('episodes')) {
                $table->foreignId('episode_id')->constrained('episodes');
            }else{
                $table->unsignedBigInteger('episode_id');
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
        Schema::dropIfExists('episode_rates');
        Schema::dropIfExists('episodes');
    }
}
