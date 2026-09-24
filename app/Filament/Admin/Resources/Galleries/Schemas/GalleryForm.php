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
                Section::make('Image')
                    ->description('Upload your artwork with the best quality.')
                    ->icon(Heroicon::OutlinedPhoto)
                    ->schema([
                        FileUpload::make('image')
                            ->label('Image')
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
                            ->helperText('Format JPG or PNG, maximum 2MB. High resolution is recommended for sharp display.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Detail Image')
                    ->description('Complete the artwork information for a neat appearance on the public page.')
                    ->icon(Heroicon::OutlinedInformationCircle)
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Title')
                            ->placeholder('Example: Sunset at Lake Beach')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1),

                        Toggle::make('is_visible')
                            ->label('Display in Public Gallery')
                            ->helperText('Disable to hide the artwork from the public page.')
                            ->default(true)
                            ->inline(false)
                            ->columnSpan(1),

                        Textarea::make('description')
                            ->label('Description/Significance (Optional)')
                            ->placeholder('Tell us the meaning or inspiration behind this artwork...')
                            ->rows(4)
                            ->maxLength(1000)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
