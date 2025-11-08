<?php

namespace App\Filament\Dosen\Resources\Quizzes\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns;
use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class QuizzesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_quiz')->label('Kode')->searchable(),
                TextColumn::make('nama_quiz')->label('Nama')->searchable(),
                TextColumn::make('durasi')->label('Durasi')->suffix(' menit'),
                TextColumn::make('start_at')->label('Mulai')->dateTime('d M Y H:i'),
                TextColumn::make('end_at')->label('Selesai')->dateTime('d M Y H:i'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state) => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                        default => 'warning',
                    }),
                TextColumn::make('total_point')->label('Total Point'),
                TextColumn::make('questions_count')->counts('questions')->label('Jumlah Soal'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Aktif',
                        'completed' => 'Selesai',
                    ]),
            ])
            ->actions([
                EditAction::make(),
                ViewAction::make(),
                DeleteAction::make(),
            ]);
    }
}
