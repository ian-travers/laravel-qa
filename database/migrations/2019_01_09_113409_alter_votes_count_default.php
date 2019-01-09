<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterVotesCountDefault extends Migration
{
    public function up()
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->integer('votes_count')->default(0)->change();
        });
    }

    public function down()
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->integer('votes_count')->change();
        });
    }
}
