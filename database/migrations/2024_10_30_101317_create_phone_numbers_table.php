<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonesTable extends Migration
{
    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->string('phone_number');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('phones');
    }
}