<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFireworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fireworks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('x');
            $table->string('y');
            $table->string('z');
            $table->string('type');


            $table->foreignId('triggered_by')
                ->nullable()
                ->references('id')->on('users');

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fireworks', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['triggered_by']);
        });
        Schema::dropIfExists('fireworks');
    }
}
