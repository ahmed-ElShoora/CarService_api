<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('tec_id');
            $table->string('client_id');
            $table->string('type')->default('waiting');
            $table->string('category_id');
            $table->string('category_price');
            $table->string('price')->nullable();
            $table->string('lat');
            $table->string('lng');
            $table->string('day_work')->nullable();
            $table->string('end_date')->nullable();
            $table->text('desc');
            $table->string('image')->nullable();
            $table->string('vidoe')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
