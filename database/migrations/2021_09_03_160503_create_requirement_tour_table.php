<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequirementTourTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirement_tour', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requirement_id')->constrained();
            $table->foreignId('tour_id')->constrained()->onDelete('cascade');
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
        Schema::table('requirement_tour', function (Blueprint $table) {
            $table->dropForeign(['requirement_id']);
            $table->dropForeign(['tour_id']);
        });
        
        Schema::dropIfExists('requirement_tour');
    }
}
