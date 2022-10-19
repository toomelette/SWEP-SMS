<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForm3DetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form3_details', function (Blueprint $table) {
            $table->id();
            $table->string('weekly_report_slug')->nullable();
            $table->decimal('manufacturedRaw',20,3)->nullable();
            $table->decimal('rao',20,3)->nullable();
            $table->decimal('manufacturedRefined',20,3)->nullable();
            $table->decimal('sharePlanter',20,3)->nullable();
            $table->decimal('shareMiller',20,3)->nullable();
            $table->decimal('refineryMolasses',20,3)->nullable();

            $table->decimal('prev_manufacturedRaw',20,3)->nullable();
            $table->decimal('prev_rao',20,3)->nullable();
            $table->decimal('prev_manufacturedRefined',20,3)->nullable();
            $table->decimal('prev_sharePlanter',20,3)->nullable();
            $table->decimal('prev_shareMiller',20,3)->nullable();
            $table->decimal('prev_refineryMolasses',20,3)->nullable();

            $table->decimal('priceRaw',20,2)->nullable();
            $table->decimal('priceRefined',20,2)->nullable();
            $table->string('storageCertRaw')->nullable();
            $table->string('storageCertRefined')->nullable();
            $table->decimal('distFactor',15,10)->nullable();
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
        Schema::dropIfExists('form3_details');
    }
}
