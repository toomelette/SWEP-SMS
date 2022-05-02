<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('su_options', function (Blueprint $table) {
            $table->id();
            $table->string('for');
            $table->string('option');
            $table->string('value');
            $table->integer('deactivated')->nullable(true);
            $table->timestamps();
        });

        \App\Models\SuOptions::query()->insert([
            [
                'for' => 'employee_status',
                'option' => 'ACTIVE',
                'value' => 'ACTIVE',
                'deactivated' => 0,
            ],
            [
                'for' => 'employee_status',
                'option' => 'INACTIVE',
                'value' => 'INACTIVE',
                'deactivated' => 0,
            ],
            [
                'for' => 'employee_status',
                'option' => 'SUSPENDED',
                'value' => 'SUSPENDED',
                'deactivated' => 0,
            ]
        ]);

        \App\Models\SuOptions::query()->insert([
            [
                'for' => 'employee_groupings',
                'option' => 'VISAYAS',
                'value' => 'VISAYAS',
                'deactivated' => 0,
            ],
            [
                'for' => 'employee_groupings',
                'option' => 'LUZON/MINDANAO',
                'value' => 'LUZON/MINDANAO',
                'deactivated' => 0,
            ],
            [
                'for' => 'employee_groupings',
                'option' => 'COS',
                'value' => 'COS',
                'deactivated' => 0,
            ],
            [
                'for' => 'employee_groupings',
                'option' => 'RETIREE',
                'value' => 'RETIREE',
                'deactivated' => 0,
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('su_options');
    }
}
