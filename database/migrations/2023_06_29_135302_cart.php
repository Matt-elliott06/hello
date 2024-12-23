<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('basket', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->integer('product_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->timestamps();

        });
    }



    public function down()
    {
        //
    }
};
