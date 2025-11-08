<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'teks_opsi',
        'urutan',
        'is_correct',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
    ];

    // Automatic urutan A, B, C, D
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($option) {
            $lastOption = self::where('question_id', $option->question_id)
                ->orderBy('urutan', 'desc')
                ->first();

            if ($lastOption) {
                $option->urutan = chr(ord($lastOption->urutan) + 1);
            } else {
                $option->urutan = 'a';
            }
        });
    }

    // Relationships
    public function questions()
    {
        return $this->belongsTo(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'selected_option_id');
    }
}
