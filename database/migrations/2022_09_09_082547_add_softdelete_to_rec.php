<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftdeleteToRec extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rec_documents', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('qc_rec_documents', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rec_documents', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('qc_rec_documents', function (Blueprint $table) {
            $table->softDeletes();
        });
    }
}
