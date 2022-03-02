<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePpuPpmpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppu_ppmp', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fiscal_year');
            $table->string('budget_type', 10);
            $table->string('resp_center', 15);
            $table->string('pap_code', 20);
            $table->string('gen_desc', 255);
            $table->double('unit_cost');
            $table->integer('qty');
            $table->string('uom', 10);
            $table->double('total_budget');
            $table->string('mode_of_proc', 50);
            $table->integer('qty_jan');
            $table->integer('qty_feb');
            $table->integer('qty_mar');
            $table->integer('qty_apr');
            $table->integer('qty_jun');
            $table->integer('qty_jul');
            $table->integer('qty_aug');
            $table->integer('qty_sep');
            $table->integer('qty_oct');
            $table->integer('qty_nov');
            $table->integer('qty_dec');
            $table->string('remark', 255);
            $table->string('user_created')->nullable(true);
            $table->string('user_updated')->nullable(true);
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
        Schema::dropIfExists('ppu_ppmp');
    }
}
