<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cms_blocks', function (Blueprint $table) {
            $table->id();
            $table->string('page');
            $table->string('section');
            $table->json('data');
            $table->timestamps();
            $table->unique(['page', 'section']);
        });

        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('source')->default('contact');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('business')->nullable();
            $table->string('country')->nullable();
            $table->string('inquiry')->nullable();
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inquiries');
        Schema::dropIfExists('cms_blocks');
    }
};
