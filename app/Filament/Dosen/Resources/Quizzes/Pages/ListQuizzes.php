<?php

namespace App\Filament\Dosen\Resources\Quizzes\Pages;

use App\Filament\Dosen\Resources\Quizzes\QuizResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListQuizzes extends ListRecords
{
    protected static string $resource = QuizResource::class;

    public function getTitle(): string
    {
        return 'Daftar Kuis';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Buat Kuis'),
        ];
    }
}
