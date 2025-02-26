<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    protected $primaryKey = 'codeEtud';
    public $incrementing = false; // Since the primary key is not auto-incrementing
    protected $keyType = 'string';

    protected $fillable = ['codeEtud', 'nom', 'prenom'];

    // Define the relationship from Etudiant to Course (many-to-many)
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_etudiant', 'codeEtud', 'codeCours')
                    ->withPivot('periode');
    }
}
