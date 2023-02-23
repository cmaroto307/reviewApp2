<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function down() {
        Schema::dropIfExists('comment');
    }
    
    public function up() {
        Schema::create('comment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('iduser');
            $table->foreignId('idreview');
            $table->text('text');
            $table->enum('stars', ['1', '2', '3', '4', '5'])->default('1');
            $table->foreign('iduser')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idreview')->references('id')->on('review')->onDelete('cascade');
            $table->timestamps();
        });
    }
};
