<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('short_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->text('original_url');
            $table->string('short_code', 100)->unique();
            $table->unsignedBigInteger('clicks')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_private')->default(false);
            $table->string('password')->nullable(); // hashed or plain (we'll hash)
            $table->timestamp('expired_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('short_links');
    }
};