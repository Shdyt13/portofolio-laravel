<?php

namespace App\Filament\Admin\Resources\Certificates\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CertificateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Sertifikat')
                    ->description('Detail sertifikat atau pencapaian yang ingin ditampilkan.')
                    ->columns(2)
                    ->components([
                        TextInput::make('name')
                            ->label('Nama Sertifikat')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: AWS Certified Cloud Practitioner')
                            ->columnSpan(1),

                        TextInput::make('issuer')
                            ->label('Penerbit (Issuer)')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Amazon Web Services')
                            ->columnSpan(1),

                        DatePicker::make('date')
                            ->label('Tanggal Terbit (Opsional)')
                            ->native(false)
                            ->displayFormat('d M Y')
                            ->columnSpan(1),

                        TextInput::make('file_url')
                            ->label('URL Kredensial (Opsional)')
                            ->helperText('Tautan verifikasi eksternal, contoh dari Credly / LinkedIn.')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://www.credly.com/...')
                            ->prefixIcon('heroicon-o-link')
                            ->columnSpan(1),
                    ]),

                Section::make('Gambar Sertifikat')
                    ->description('Unggah scan atau tangkapan layar sertifikat (format gambar, maks. 2MB).')
                    ->columns(1)
                    ->components([
                        FileUpload::make('image')
                            ->label('Gambar Sertifikat')
                            ->image()
                            ->imageEditor()
                            ->imagePreviewHeight('250')
                            ->directory('certificates')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->helperText('Format yang didukung: JPG, PNG, WEBP.')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
