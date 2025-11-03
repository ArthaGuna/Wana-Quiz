<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Session;

class QuizPage extends Component
{
    public function mount()
    {
        if (!Session::get('quiz_started')) {
            return redirect()->route('quiz.login');
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.quiz-page');
    }
}
