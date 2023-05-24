<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('completions', function (Blueprint $table) {
            $table->id();
            $table->string('hash')->nullable();
            $table->longText('prompt');
            $table->longText('result')->nullable()->default(null);
            $table->integer('prompt_tokens')->nullable()->default(null);
            $table->integer('completion_tokens')->nullable()->default(null);
            $table->string('error')->nullable()->default(null);
            $table->string('finish_reason')->nullable()->default(null);
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('automation_id')->references('id')->on('automations')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('completions');
    }
};
