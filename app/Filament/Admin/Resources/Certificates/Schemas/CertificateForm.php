<?php

namespace App\Filament\Admin\Resources\Certificates\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
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

                        DatePicker::make('issue_date')
                            ->label('Tanggal Terbit (Opsional)')
                            ->native(false)
                            ->displayFormat('d M Y')
                            ->columnSpan(1),

                        Select::make('category')
                            ->label('Kategori')
                            ->options([
                                'Web Development' => 'Web Development',
                                'Cloud' => 'Cloud',
                                'Data' => 'Data',
                                'Design' => 'Design',
                                'Lainnya' => 'Lainnya',
                            ])
                            ->searchable()
                            ->createOptionForm([
                                TextInput::make('name')->required(),
                            ])
                            ->columnSpan(1),

                        TextInput::make('credential_id')
                            ->label('ID Kredensial (Opsional)')
                            ->maxLength(255)
                            ->placeholder('Contoh: ABC-123456')
                            ->columnSpan(1),

                        TextInput::make('credential_url')
                            ->label('URL Kredensial (Opsional)')
                            ->helperText('Tautan verifikasi eksternal, contoh dari Credly / LinkedIn.')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://www.credly.com/...')
                            ->prefixIcon('heroicon-o-link')
                            ->columnSpan(1),

                        Toggle::make('is_visible')
                            ->label('Tampilkan di Portofolio')
                            ->default(true)
                            ->columnSpanFull(),
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