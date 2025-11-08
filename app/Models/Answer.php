<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'attempt_id',
        'question_id',
        'selected_option_id',
        'jawaban_essay',
        'ai_feedback',
        'ai_score',
        'final_score',
    ];

    // Relationships
    public function attempt()
    {
        return $this->belongsTo(QuizAttempt::class, 'attempt_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function selectedOption()
    {
        return $this->belongsTo(Option::class, 'selected_option_id');
    }

    // Methods
    public function isCorrect()
    {
        if ($this->question->isPilihanGanda()) {
            return $this->selectedOption && $this->selectedOption->is_correct;
        }
        return false;
    }

    public function calculateScore()
    {
        if ($this->question->isPilihanGanda()) {
            $this->final_score = $this->isCorrect() ? $this->question->point : 0;
        } else {
            // Untuk essay, gunakan ai_score sebagai persentase
            $this->final_score = $this->ai_score
                ? ($this->question->point * $this->ai_score / 100)
                : 0;
        }
        $this->save();
        return $this->final_score;
    }
}
