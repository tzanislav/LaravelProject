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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('project')->default('Default Project'); // Set a default value for 'project'
            $table->string('room')->default('Default Room'); // Set a default value for 'room'
            $table->string('itemName');
            $table->integer('count')->default(0); // Set a default value for 'count'
            $table->string('category');
            $table->string('measure')->default('бр') ->nullable();
            $table->string('company') ->nullable();
            $table->string('provider') ->nullable();
            $table->string('description') ->nullable();
            $table->string('status')->default('неизбрано'); // Set a default value for 'status'
            $table->string('price1') ->nullable();
            $table->string('price2') ->nullable();
            $table->string('proforma') ->nullable();
            $table->string('owner');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
