<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_data', function (Blueprint $table) {
            $table->id();
            $table->string('serviceProvider');
            $table->float('upload');
            $table->float('download');
            $table->decimal('longitude', $precision = 11, $scale = 8);
            $table->decimal('latitude', $precision = 10, $scale = 8);
            $table->date('created_at');
            $table->time('time_created', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_data');
    }
}
