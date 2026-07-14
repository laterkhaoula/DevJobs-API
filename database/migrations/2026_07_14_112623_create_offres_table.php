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
        Schema::create('offres', function (Blueprint $table) {
            $table->id();

            // Entreprise propriétaire de l'offre
            $table->foreignId('entreprise_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Informations de l'offre
            $table->string('titre');
            $table->text('description');
            $table->string('type_contrat');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offres');
    }
};