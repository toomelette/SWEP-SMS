<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrDtrEditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_dtr_edits', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('employee_no');
            $table->string('biometric_user_id');
            $table->time('time');
            $table->timestamps();
            $table->string('user_created');
            $table->string('user_updated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hr_dtr_edits');
    }
}
