<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSignatoriesToForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_signatories_saved',function (Blueprint $table){
            $table->id();
            $table->string('weekly_report_slug');
            $table->string('form')->nullable();
            $table->string('for')->nullable();
            $table->string('name')->nullable();
            $table->string('position')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_signatories_saved');
    }
}
