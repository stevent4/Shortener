<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('short_link_clicks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('short_link_id')->constrained()->cascadeOnDelete();
            $table->string('ip_address');           // <-- pastikan nama kolom ini 'ip'
            $table->string('user_agent')->nullable();
            $table->string('referrer')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('short_link_clicks');
    }
};
