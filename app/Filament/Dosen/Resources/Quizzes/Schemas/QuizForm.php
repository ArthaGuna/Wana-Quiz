<?php

namespace App\Filament\Dosen\Resources\Quizzes\Schemas;

use Filament\Actions\ButtonAction;
use Filament\Schemas\Schema;
use Filament\Forms\Components as Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Illuminate\Support\Str;

class QuizForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Wizard::make([
                // STEP 1
                Step::make('Informasi Kuis')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        TextInput::make('nama_quiz')
                            ->label('Nama Kuis')
                            ->required(),

                        TextInput::make('durasi')
                            ->label('Durasi')
                            ->numeric()
                            ->minValue(1)
                            ->default(30)
                            ->suffix('Menit'),

                        DateTimePicker::make('start_at')
                            ->label('Waktu Mulai')
                            ->required()
                            ->seconds(false),

                        DateTimePicker::make('end_at')
                            ->label('Waktu Selesai')
                            ->required()
                            ->seconds(false),

                        Toggle::make('acak_soal')
                            ->label('Acak Soal')
                            ->default(true),

                        Toggle::make('allow_retry')
                            ->label('Boleh Coba Ulang')
                            ->reactive(),

                        TextInput::make('max_coba')
                            ->label('Maksimal Percobaan')
                            ->numeric()
                            ->minValue(1)
                            ->visible(fn($get) => $get('allow_retry')),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Aktif',
                            ])
                            ->default('draft')
                            ->required(),
                    ])
                    ->columns(2),

                // STEP 2
                Step::make('Soal Pilihan Ganda')
                    ->icon('heroicon-o-list-bullet')
                    ->schema([
                        Repeater::make('pilihanGandaQuestions')
                            ->relationship('pilihanGandaQuestions')
                            ->schema([
                                Hidden::make('tipe_soal')->default('pilihan_ganda'),

                                Grid::make(2)->schema([
                                    TextInput::make('teks_soal')
                                        ->label('Pertanyaan')
                                        ->required(),

                                    TextInput::make('point')
                                        ->label('Point')
                                        ->numeric()
                                        ->default(10),
                                ]),

                                Repeater::make('options')
                                    ->relationship('options')
                                    ->schema([
                                        TextInput::make('teks_opsi')->label('Opsi')->required(),
                                        Toggle::make('is_correct')->label('Benar'),
                                    ])
                                    ->defaultItems(4)
                                    ->minItems(2)
                                    ->maxItems(6)
                                    ->collapsed()
                                    ->itemLabel(fn(array $state): ?string => Str::limit($state['teks_opsi'] ?? 'Opsi baru', 100)),
                            ])
                            ->collapsed()
                            ->itemLabel(fn(array $state): ?string => Str::limit($state['teks_soal'] ?? 'Soal baru', 100))
                            ->createItemButtonLabel('Tambah Soal Pilihan Ganda'),
                    ]),

                // STEP 3
                Step::make('Soal Essay')
                    ->icon('heroicon-o-pencil')
                    ->schema([
                        Repeater::make('essayQuestions')
                            ->relationship('essayQuestions')
                            ->schema([
                                Hidden::make('tipe_soal')
                                    ->default('essay'),
                                TextInput::make('teks_soal')
                                    ->label('Pertanyaan Essay')
                                    ->required(),

                                Grid::make(2)->schema([
                                    TextInput::make('point')
                                        ->numeric()
                                        ->suffix('Point')
                                        ->hiddenLabel()
                                        ->default(20),

                                    ButtonAction::make('add_image')
                                        ->label('Tambah Gambar')
                                        ->action(function (Get $get, Set $set) {
                                            $set('has_image', true);
                                        }),
                                ]),

                                FileUpload::make('gambar')
                                    ->label('Upload Gambar')
                                    ->image()
                                    ->directory('soal-images')
                                    ->maxSize(2048)
                                    ->visible(fn($get) => $get('has_image') === true),
                            ])
                            ->createItemButtonLabel('Tambah Soal Essay'),
                    ]),

                // STEP 4
                Step::make('Kode Kuis')
                    ->icon('heroicon-o-qr-code')
                    ->schema([
                        Placeholder::make('kode_quiz')
                            ->label('Kode Kuis')
                            ->content(fn($record) => $record?->kode_quiz ?? 'Akan digenerate otomatis setelah create'),
                    ]),
            ])
                ->columnSpanFull()
                ->persistStepInQueryString(),
        ]);
    }
}
