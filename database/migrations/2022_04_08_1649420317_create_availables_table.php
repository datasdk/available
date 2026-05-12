<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailablesTable extends Migration
{
    public function up()
    {

		
		if(!Schema::hasTable('availables'))
        Schema::create('availables', function (Blueprint $table) {
		$table->increments('id');
		$table->morphs('availability');
		$table->boolean('always_available')->default(0);
		$table->boolean('monday')->default(0);
		$table->boolean('tuesday')->default(0);
		$table->boolean('wednesday')->default(0);
		$table->boolean('thursday')->default(0);
		$table->boolean('friday')->default(0);
		$table->boolean('saturday')->default(0);
		$table->boolean('sunday')->default(0);
		$table->boolean('all_day')->default(0);
		$table->smallInteger('from_hours')->nullable();
		$table->smallInteger('from_minutes')->nullable();
		$table->smallInteger('to_hours')->nullable();
		$table->smallInteger('to_minutes')->nullable();
		$table->timestamp('from')->nullable();
		$table->timestamp('to')->nullable();
		$table->timestamps();

        });
    }

    public function down()
    {
		if(Schema::hasTable("availables"))
        Schema::dropIfExists('availables');
    }
}