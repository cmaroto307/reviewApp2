<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function down() {
        Schema::dropIfExists('review');
    }
    
    public function up() {
        Schema::create('review', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 80);
            $table->enum('tipo', ['film', 'record', 'book']);
            $table->string('review', 1000);
            $table->binary('thumbnail');
            $table->foreignId('iduser');
            $table->integer('ncomments');
            $table->decimal('stars', 3, 2);
            $table->foreign('iduser')->references('id')->on('users');
            $table->timestamps();
        });
        $sql = 'alter table review change thumbnail thumbnail longblob';
        DB::statement($sql);
    }
};
