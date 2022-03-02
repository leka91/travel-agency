<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBelgradeImageColumnToBelgradeQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('belgrade_quotes', function (Blueprint $table) {
            $table->string('belgrade_image')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('belgrade_quotes', function (Blueprint $table) {
            $table->dropColumn('belgrade_image');
        });
    }
}
