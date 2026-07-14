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
        Schema::create('candidatures', function (Blueprint $table) {
            $table->id();

            // Candidat
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Offre concernée
            $table->foreignId('offre_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Statut de la candidature
            $table->enum('statut', [
                'en_attente',
                'acceptee',
                'refusee'
            ])->default('en_attente');

            // Un candidat ne peut postuler qu'une seule fois à la même offre
            $table->unique(['user_id', 'offre_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidatures');
    }
};