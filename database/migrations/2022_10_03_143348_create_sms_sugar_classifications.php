<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsSugarClassifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_sugar_classifications', function (Blueprint $table) {
            $table->id();
            $table->string('sugar_class');
            $table->string('swapping')->nullable();
            $table->string('is_active')->nullable();
            $table->string('sorting')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_sugar_classifications');
    }
}
