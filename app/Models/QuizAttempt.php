<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'user_id',
        'start_time',
        'end_time',
        'total_score',
        'status',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    // Relationships
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'attempt_id');
    }

    // Methods
    public function calculateTotalScore()
    {
        $total = $this->answers()->sum('final_score');
        $this->update(['total_score' => $total]);
        return $total;
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function getRemainingTime()
    {
        $endTime = $this->start_time->addMinutes($this->quiz->durasi);
        return now()->diffInSeconds($endTime, false);
    }

    public function isTimeout()
    {
        return $this->getRemainingTime() <= 0;
    }
}
