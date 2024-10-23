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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->string('link');
            $table->date('date');
            $table->text('content');
            $table->enum('status', ['Published', 'For Edit'])->nullable()->default(null);
            $table->foreignId('writer_id')->nullable()->default(null)->constrained(table: 'users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('editor_id')->nullable()->default(null)->constrained(table: 'users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('company_id')->nullable()->constrained(table: 'companies')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
