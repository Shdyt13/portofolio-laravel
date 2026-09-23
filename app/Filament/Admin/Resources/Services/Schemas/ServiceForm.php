<?php

namespace App\Filament\Admin\Resources\Services\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Layanan')
                    ->description('Detail utama layanan yang akan ditampilkan di halaman publik.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Layanan')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Website Development')
                            ->columnSpanFull(),

                        TextInput::make('icon')
                            ->label('Icon (Heroicon)')
                            ->maxLength(255)
                            ->placeholder('heroicon-o-code-bracket')
                            ->helperText('Nama heroicon yang dipakai di frontend, mis. heroicon-o-sparkles.')
                            ->prefixIcon('heroicon-o-sparkles')
                            ->columnSpan(1),

                        TextInput::make('price')
                            ->label('Tarif / Harga')
                            ->maxLength(255)
                            ->placeholder('Contoh: Mulai dari Rp1.500.000')
                            ->helperText('Boleh diisi angka atau teks bebas.')
                            ->columnSpan(1),

                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(4)
                            ->maxLength(1000)
                            ->placeholder('Jelaskan singkat cakupan layanan ini...')
                            ->columnSpanFull(),
                    ]),

                Section::make('Tampilan')
                    ->description('Pengaturan urutan dan visibilitas layanan.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('display_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0)
                            ->required()
                            ->minValue(0)
                            ->helperText('Angka lebih kecil tampil lebih dulu.')
                            ->columnSpan(1),

                        Toggle::make('is_visible')
                            ->label('Tampilkan di Halaman Publik')
                            ->default(true)
                            ->inline(false)
                            ->columnSpan(1),
                    ]),
            ]);
    }
}
