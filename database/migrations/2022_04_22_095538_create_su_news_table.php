<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('su_news', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('title');
            $table->longText('details')->nullable(true);
            $table->longText('descriptive_details')->nullable(true);
            $table->string('author')->nullable(true);
            $table->string('author_position')->nullable(true);
            $table->dateTime('expires_on')->nullable(true);
            $table->integer('is_active')->nullable(true);
            $table->integer('severity')->nullable(true);
            $table->string('attachment_type')->nullable(true);
            $table->string('attachment_location')->nullable(true);
            $table->timestamps();
            $table->string('user_created')->nullable(true);
            $table->string('user_updated')->nullable(true);
            $table->string('ip_created')->nullable(true);
            $table->string('ip_updated')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('su_news');
    }
}
