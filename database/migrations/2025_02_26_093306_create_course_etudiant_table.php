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
        Schema::create('course_etudiant', function (Blueprint $table) {
            $table->string('codeEtud');  // Foreign key to Etudiant
            $table->string('codeCours'); // Foreign key to Course
            $table->string('periode');   // Period field in the pivot table
            
            // Composite primary key on codeEtud and codeCours
            $table->primary(['codeEtud', 'codeCours']);
            
            // Foreign keys
            $table->foreign('codeEtud')->references('codeEtud')->on('etudiants')->onDelete('cascade');
            $table->foreign('codeCours')->references('codeCours')->on('courses')->onDelete('cascade');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_etudiant');
    }
};
