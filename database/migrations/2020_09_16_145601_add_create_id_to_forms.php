<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreateIdToForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forms', function (Blueprint $table) {
            $table->integer('created_id')->nullable()->after('numbering_prefix');
            $table->string('created_name', 255)->nullable()->after('created_id');
            $table->integer('updated_id')->nullable()->after('created_at');
            $table->string('updated_name', 255)->nullable()->after('updated_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forms', function (Blueprint $table) {
            $table->dropColumn('created_id');
            $table->dropColumn('created_name');
            $table->dropColumn('updated_id');
            $table->dropColumn('updated_name');
        });
    }
}
