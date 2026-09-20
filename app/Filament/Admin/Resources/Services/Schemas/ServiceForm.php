<?php

namespace App\Filament\Admin\Resources\Services\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Layanan')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: Website Development'),

                TextInput::make('fee')
                    ->label('Tarif')
                    ->maxLength(255)
                    ->placeholder('Contoh: Mulai dari Rp1.500.000')
                    ->helperText('Boleh diisi angka atau teks bebas (mis. "Mulai dari ...").'),

                TextInput::make('icon')
                    ->label('Icon (Heroicon)')
                    ->maxLength(255)
                    ->placeholder('heroicon-o-code-bracket')
                    ->helperText('Nama heroicon yang dipakai di frontend, contoh: heroicon-o-globe-alt.')
                    ->prefixIcon('heroicon-o-sparkles'),

                TextInput::make('display_order')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->default(0),

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(4)
                    ->maxLength(1000)
                    ->placeholder('Jelaskan singkat cakupan layanan ini...'),

                Toggle::make('is_visible')
                    ->label('Tampilkan di Halaman Publik')
                    ->default(true)
                    ->inline(false),
            ]);
    }
}