<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // Use the default primary key 'codeCours'
    protected $primaryKey = 'codeCours';

    public $incrementing = false; // Set incrementing to false because the primary key is not auto-incrementing
    protected $keyType = 'string'; // Set the key type to string because codeCours is not an integer

    protected $fillable = ['codeCours', 'intitule', 'nbrH'];

    // Define the relationship from Course to Etudiant (many-to-many)
    public function etudiants()
    {
        return $this->belongsToMany(Etudiant::class, 'course_etudiant', 'codeCours', 'codeEtud')
                    ->withPivot('periode');
    }
}
