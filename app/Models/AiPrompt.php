<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiPrompt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_prompt',
        'template_prompt',
        'model_id',
        'max_tokens',
        'temperature',
        'status',
    ];

    protected $casts = [
        'temperature' => 'decimal:2',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Methods
    public function isActive()
    {
        return $this->status === 'active';
    }

    public function formatPrompt($soal, $jawaban)
    {
        return str_replace(
            ['{soal}', '{jawaban}'],
            [$soal, $jawaban],
            $this->template_prompt
        );
    }
}
