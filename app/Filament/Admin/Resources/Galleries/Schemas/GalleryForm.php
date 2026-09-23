<?php

namespace App\Filament\Admin\Resources\Galleries\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Gambar Lukisan')
                    ->description('Unggah foto karya seni dengan kualitas terbaik.')
                    ->icon(Heroicon::OutlinedPhoto)
                    ->schema([
                        FileUpload::make('image')
                            ->label('Gambar Lukisan')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '1:1',
                                '4:3',
                                '16:9',
                            ])
                            ->imagePreviewHeight('280')
                            ->directory('galleries')
                            ->openable()
                            ->downloadable()
                            ->required()
                            ->maxSize(2048)
                            ->helperText('Format JPG atau PNG, maksimal 2MB. Disarankan resolusi tinggi agar tajam saat ditampilkan.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Detail Lukisan')
                    ->description('Lengkapi informasi karya agar tampil rapi di halaman publik.')
                    ->icon(Heroicon::OutlinedInformationCircle)
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Lukisan')
                            ->placeholder('Contoh: Senja di Danau Toba')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1),

                        Toggle::make('is_visible')
                            ->label('Tampilkan di Galeri Publik')
                            ->helperText('Nonaktifkan untuk menyembunyikan lukisan dari halaman publik.')
                            ->default(true)
                            ->inline(false)
                            ->columnSpan(1),

                        Textarea::make('description')
                            ->label('Deskripsi/Makna Lukisan (Opsional)')
                            ->placeholder('Ceritakan makna atau inspirasi di balik karya ini...')
                            ->rows(4)
                            ->maxLength(1000)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
