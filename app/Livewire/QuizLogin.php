<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Session;

class QuizLogin extends Component
{
    public $quizCode = '';
    public $errorMessage = '';

    public function submit()
    {
        if ($this->quizCode === 'ABC123') {
            Session::put('quiz_started', true);
            return redirect()->route('quiz.page');
        }

        $this->errorMessage = 'Kode kuis salah!';
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.quiz-login');
    }
}
