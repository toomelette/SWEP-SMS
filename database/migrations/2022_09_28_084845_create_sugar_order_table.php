<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSugarOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sugar_order', function (Blueprint $table) {
            $table->id();
            $table->string('sugar_order');
            $table->date('effectivity')->nullable();
            $table->decimal('A',5,2);
            $table->decimal('B',5,2);
            $table->decimal('C',5,2);
            $table->decimal('C1',5,2);
            $table->decimal('D',5,2);
            $table->decimal('DX',5,2);
            $table->decimal('DE',5,2);
            $table->decimal('DR',5,2);
            $table->string('user_created')->nullable();
            $table->string('user_updated')->nullable();
            $table->string('ip_created')->nullable();
            $table->string('ip_updated')->nullable();
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
        Schema::dropIfExists('sugar_order');
    }
}
