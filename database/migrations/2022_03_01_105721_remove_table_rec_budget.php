<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveTableRecBudget extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('rec_budget');

        Schema::create('ppu_rec_budget', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->integer('fiscal_year');
            $table->string('budget_type',10);
            $table->string('resp_center',15);
            $table->string('pap_title');
            $table->string('pap_code',20);
            $table->string('pap_desc',255)->nullable(true);
            $table->decimal('ps',20,2)->nullable(true);
            $table->decimal('co',20,2)->nullable(true);
            $table->decimal('mooe',20,2)->nullable(true);
            $table->decimal('pcent_share',5,2)->nullable(true);
            $table->string('division')->nullable(true);
            $table->string('section')->nullable(true);
            $table->string('user_created')->nullable(true);
            $table->string('user_updated')->nullable(true);
            $table->string('ip_created')->nullable(true);
            $table->string('ip_updated')->nullable(true);
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
        Schema::create('rec_budget', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fiscal_year');
            $table->string('budget_type',10);
            $table->string('resp_center',15);
            $table->string('pap_code',20);
            $table->string('pap_desc',255);
            $table->decimal('ps',20,2);
            $table->decimal('co',20,2);
            $table->decimal('mooe',20,2);
            $table->decimal('pcent_share',5,2);
            $table->string('user_created')->nullable(true);
            $table->string('user_updated')->nullable(true);
            $table->string('ip_created')->nullable(true);
            $table->string('ip_updated')->nullable(true);
            $table->timestamps();
        });

        Schema::dropIfExists('ppu_rec_budget');
    }
}
