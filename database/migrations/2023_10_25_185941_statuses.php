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
        //
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->string('targetProject')->nullable();
            $table->text('owner') ->default('admin') ;
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('statuses');
    }
};
