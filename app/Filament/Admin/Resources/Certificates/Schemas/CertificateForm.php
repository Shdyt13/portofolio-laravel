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
                Section::make('Certificate Information')
                    ->description('Details of the certificates or achievements you want to display.')
                    ->columns(2)
                    ->components([
                        TextInput::make('name')
                            ->label('Certificate Name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: AWS Certified Cloud Practitioner')
                            ->columnSpan(1),

                        TextInput::make('issuer')
                            ->label('Issuer / Penerbit')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Example: Web Development Certificate')
                            ->columnSpan(1),

                        DatePicker::make('issue_date')
                            ->label('Issue Date (Optional)')
                            ->native(false)
                            ->displayFormat('d M Y')
                            ->columnSpan(1),

                        Select::make('category')
                            ->label('Category')
                            // Perbarui path Get di sini
                            ->options(function (\Filament\Schemas\Components\Utilities\Get $get) {
                                $defaultOptions = [
                                    'Web Development' => 'Web Development',
                                    'Cloud' => 'Cloud',
                                'Data' => 'Data',
                                'Design' => 'Design',
                                'Lainnya' => 'Lainnya',
                            ];

                            $currentCategory = $get('category');

                            if ($currentCategory && !isset($defaultOptions[$currentCategory])) {
                                $defaultOptions[$currentCategory] = $currentCategory;
                            }

                            return $defaultOptions;
                        })
                        ->searchable()
                        ->createOptionForm([
                            TextInput::make('name')
                                ->label('New Category Name')
                                ->required(),
                        ])
                        ->createOptionUsing(function (array $data): string {
                            return $data['name'];
                        })
                        ->columnSpan(1),

                        TextInput::make('credential_id')
                            ->label('Credential ID (Optional)')
                            ->maxLength(255)
                            ->placeholder('Example: ABC-123456')
                            ->columnSpan(1),

                        TextInput::make('credential_url')
                            ->label('Credential URL (Optional)')
                            ->helperText('External verification link, e.g., from Credly / LinkedIn.')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://www.credly.com/...')
                            ->prefixIcon('heroicon-o-link')
                            ->columnSpan(1),

                        Toggle::make('is_visible')
                            ->label('Display in Portfolio')
                            ->default(true)
                            ->columnSpanFull(),
                    ]),

                Section::make('Certificate Image')
                    ->description('Upload a scan or screenshot of the certificate (image format, max. 2MB).')
                    ->columns(1)
                    ->components([
                        FileUpload::make('image')
                            ->label('Certificate Image')
                            ->image()
                            ->imageEditor()
                            ->imagePreviewHeight('250')
                            ->directory('certificates')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->helperText('Supported formats: JPG, PNG, WEBP. Maximum size: 2 MB.')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}