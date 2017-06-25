<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImportAlltables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::unprepared(file_get_contents('/Users/ram-3371/Downloads/connected_table.sql'));
        DB::unprepared(file_get_contents('/Users/ram-3371/Downloads/diary_table.sql'));
        DB::unprepared(file_get_contents('/Users/ram-3371/Downloads/library_table.sql'));
        DB::unprepared(file_get_contents('/Users/ram-3371/Downloads/logs_table.sql'));
        DB::unprepared(file_get_contents('/Users/ram-3371/Downloads/misc_cr_table.sql'));
        DB::unprepared(file_get_contents('/Users/ram-3371/Downloads/petition_table.sql'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
