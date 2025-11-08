<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kode_quiz',
        'nama_quiz',
        'durasi',
        'acak_soal',
        'allow_retry',
        'max_coba',
        'start_at',
        'end_at',
        'status',
        'total_point',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'acak_soal' => 'boolean',
        'allow_retry' => 'boolean',
    ];

    // Automatic kode_quiz generation
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($quiz) {
            $quiz->user_id = Auth::id();

            $quiz->kode_quiz = self::generateKodeQuiz();
        });

        static::created(function ($quiz) {
            $quiz->calculateTotalPoint();
        });
    }

    public static function generateKodeQuiz()
    {
        do {
            $letters = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3);
            $numbers = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
            $lastLetter = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 1);
            $kode = $letters . $numbers . $lastLetter;
        } while (self::where('kode_quiz', $kode)->exists());

        return $kode;
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'quiz_id');
    }

    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class, 'quiz_id');
    }

    public function pilihanGandaQuestions()
    {
        return $this->hasMany(Question::class, 'quiz_id')->where('tipe_soal', 'pilihan_ganda');
    }

    public function essayQuestions()
    {
        return $this->hasMany(Question::class, 'quiz_id')->where('tipe_soal', 'essay');
    }

    // Methods
    public function isActive()
    {
        return $this->status === 'published' &&
            now()->between($this->start_at, $this->end_at);
    }

    public function calculateTotalPoint()
    {
        $total = $this->questions()->sum('point');
        $this->update(['total_point' => $total]);
        return $total;
    }

    public function getTotalPointAttribute()
    {
        return $this->questions()->sum('point');
    }
}
