<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreatmentSonographiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatment_sonographies', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('treatment_id')
            ->constrained()
            ->onDelete('cascade');
              
            $table->foreignId('sonography_id')->nullable()->constrained()->onDelete('cascade');
        
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
        Schema::dropIfExists('treatment_sonographies');
    }
}
