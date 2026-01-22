<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('site', function (Blueprint $table) {
            $table->longText('deskripsi')->change();
            $table->longText('tentang')->change();
        });
    }

    public function down()
    {
        Schema::table('site', function (Blueprint $table) {
            $table->string('deskripsi')->change();
            $table->string('tentang')->change();
        });
    }
};
