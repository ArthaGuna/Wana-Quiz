<?php

namespace App\Filament\Dosen\Resources\Quizzes;

use App\Filament\Dosen\Resources\Quizzes\Pages\CreateQuiz;
use App\Filament\Dosen\Resources\Quizzes\Pages\EditQuiz;
use App\Filament\Dosen\Resources\Quizzes\Pages\ListQuizzes;
use App\Filament\Dosen\Resources\Quizzes\Schemas\QuizForm;
use App\Filament\Dosen\Resources\Quizzes\Tables\QuizzesTable;
use App\Models\Quiz;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class QuizResource extends Resource
{
    protected static ?string $model = Quiz::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::DocumentText;

    protected static ?string $recordTitleAttribute = 'nama_quiz';

    protected static ?string $navigationLabel = 'Kuis Saya';

    protected static string|UnitEnum|null $navigationGroup = 'Kuis Management';

    public static function form(Schema $schema): Schema
    {
        return QuizForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuizzesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListQuizzes::route('/'),
            'create' => CreateQuiz::route('/create'),
            'edit' => EditQuiz::route('/{record}/edit'),
        ];
    }
}
