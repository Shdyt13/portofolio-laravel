<?php

namespace App\Filament\Admin\Resources\Skills\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class SkillForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Section::make('Logo / Ikon')
                    ->description('Tampil sebagai ikon skill di halaman depan.')
                    ->icon(Heroicon::OutlinedPhoto)
                    ->columnSpan(1)
                    ->schema([
                        FileUpload::make('image')
                            ->hiddenLabel()
                            ->image()
                            ->directory('skills')
                            ->visibility('public')
                            ->maxSize(1024) // Maksimal 1MB
                            ->acceptedFileTypes(['image/png', 'image/svg+xml', 'image/webp'])
                            ->imageEditor()
                            ->alignCenter()
                            ->helperText('PNG transparan atau SVG agar menyatu dengan tema gelap/terang. Maksimal 1 MB.'),
                    ]),

                Section::make('Detail Skill')
                    ->description('Nama teknologi, tools, atau keahlian yang ingin ditampilkan.')
                    ->icon(Heroicon::OutlinedSparkles)
                    ->columnSpan(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Skill')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Laravel, Python, Docker')
                            ->prefixIcon(Heroicon::OutlinedCodeBracket)
                            ->live(onBlur: true),
                    ]),
            ]);
    }
}
