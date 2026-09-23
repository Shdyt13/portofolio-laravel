<?php

namespace App\Filament\Admin\Resources\Projects\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3) // Membagi keseluruhan form menjadi 3 kolom utama
            ->components([
                
                // ==========================================
                // KONTEN UTAMA (KIRI) - Mengambil 2 Kolom
                // ==========================================
                Grid::make(1)
                    ->schema([
                        Section::make('Informasi Project')
                            ->description('Detail utama project yang akan ditampilkan ke publik.')
                            ->columns(2) // Input di dalam section ini dibagi 2
                            ->components([
                                TextInput::make('name')
                                    ->label('Nama Project')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpan(1),

                                Select::make('status')
                                    ->options([
                                        'draft' => 'Draft',
                                        'in_progress' => 'In Progress',
                                        'completed' => 'Completed',
                                        'archived' => 'Archived',
                                    ])
                                    ->native(false)
                                    ->columnSpan(1),

                                FileUpload::make('thumbnail')
                                    ->label('Thumbnail')
                                    ->image()
                                    ->imageEditor()
                                    ->directory('projects')
                                    ->columnSpanFull(),

                                Textarea::make('description')
                                    ->label('Deskripsi')
                                    ->rows(5) // Sedikit ditinggikan agar lebih nyaman untuk mengetik
                                    ->columnSpanFull(),

                                // Relasi Many-to-Many ke tabel Skills
                                Select::make('skills')
                                    ->relationship('skills', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->searchable()
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(2),

                // ==========================================
                // SIDEBAR (KANAN) - Mengambil 1 Kolom
                // ==========================================
                Grid::make(1)
                    ->schema([
                        Section::make('Tautan')
                            ->columns(1) // Diubah ke 1 kolom agar memanjang ke bawah di sidebar
                            ->components([
                                TextInput::make('github_url')
                                    ->label('GitHub URL')
                                    ->url()
                                    ->maxLength(255)
                                    ->prefixIcon('heroicon-o-code-bracket'),

                                TextInput::make('demo_url')
                                    ->label('Demo URL')
                                    ->url()
                                    ->maxLength(255)
                                    ->prefixIcon('heroicon-o-globe-alt'),
                            ]),

                        Section::make('Pengaturan Tampilan')
                            ->columns(1) // Diubah ke 1 kolom agar sejajar rapi di sidebar
                            ->components([
                                TextInput::make('display_order')
                                    ->label('Urutan Tampil')
                                    ->numeric()
                                    ->default(0)
                                    ->required()
                                    ->helperText('Angka terkecil tampil lebih dulu.'),

                                Toggle::make('featured')
                                    ->label('Featured')
                                    ->default(false)
                                    ->inline(false),

                                Toggle::make('is_visible')
                                    ->label('Tampilkan')
                                    ->default(true)
                                    ->inline(false),
                            ]),
                    ])
                    ->columnSpan(1),

            ]);
    }
}