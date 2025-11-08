<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'tipe_soal',
        'teks_soal',
        'gambar',
        'point',
        'urutan',
    ];

    // Relationships
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    // Methods
    public function isPilihanGanda()
    {
        return $this->tipe_soal === 'pilihan_ganda';
    }

    public function isEssay()
    {
        return $this->tipe_soal === 'essay';
    }

    public function getCorrectOption()
    {
        return $this->options()->where('is_correct', true)->first();
    }
}
