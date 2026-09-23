<?php

namespace App\Filament\Admin\Resources\Profiles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Section::make('Foto Profil')
                    ->description('Gambar ini tampil sebagai avatar di halaman depan.')
                    ->icon(Heroicon::OutlinedCamera)
                    ->columnSpan(1)
                    ->schema([
                        FileUpload::make('avatar')
                            ->hiddenLabel()
                            ->image()
                            ->avatar()
                            ->imageEditor()
                            ->circleCropper()
                            ->directory('profile')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->helperText('JPG, PNG, atau WEBP. Maksimal 2 MB.')
                            ->alignCenter(),
                    ]),

                Section::make('Informasi Dasar')
                    ->description('Nama dan profesi yang ditampilkan di bagian hero.')
                    ->icon(Heroicon::OutlinedIdentification)
                    ->columnSpan(2)
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->placeholder('Contoh: Rangga Pratama')
                            ->required()
                            ->maxLength(255)
                            ->prefixIcon(Heroicon::OutlinedUser),

                        TextInput::make('title')
                            ->label('Profesi / Jabatan')
                            ->placeholder('Contoh: Fullstack Web Developer')
                            ->required()
                            ->maxLength(255)
                            ->prefixIcon(Heroicon::OutlinedBriefcase),

                        TextInput::make('cv_link')
                        ->label('Link Google Drive CV')
                        ->url()
                        ->placeholder('https://drive.google.com/file/d/...')
                        ->maxLength(255)
                        ->columnSpanFull(),
                    ]),

                Section::make('Tentang Saya')
                    ->description('Deskripsi singkat, 2–4 kalimat sudah cukup.')
                    ->icon(Heroicon::OutlinedDocumentText)
                    ->columnSpanFull()
                    ->schema([
                        Textarea::make('about')
                            ->hiddenLabel()
                            ->placeholder('Ceritakan pengalaman, keahlian, dan minat Anda...')
                            ->required()
                            ->rows(6)
                            ->maxLength(1000)
                            ->live(debounce: 500)
                            ->helperText(fn (?string $state): string => strlen((string) $state) . ' / 1000 karakter')
                            ->columnSpanFull(),
                    ]),

                // SECTION BARU UNTUK SOSIAL MEDIA
                Section::make('Sosial Media')
                    ->description('Tautan profil untuk dihubungkan di bagian About.')
                    ->icon('heroicon-o-link')
                    ->columns(3)
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('github_url')
                            ->label('GitHub URL')
                            ->url()
                            ->placeholder('https://github.com/username')
                            ->prefixIcon('heroicon-o-globe-alt'),
                        
                        TextInput::make('linkedin_url')
                            ->label('LinkedIn URL')
                            ->url()
                            ->placeholder('https://linkedin.com/in/username')
                            ->prefixIcon('heroicon-o-globe-alt'),
                        
                        TextInput::make('instagram_url')
                            ->label('Instagram URL')
                            ->url()
                            ->placeholder('https://instagram.com/username')
                            ->prefixIcon('heroicon-o-globe-alt'),
                    ]),
            ]);
    }
}