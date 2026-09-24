<?php

namespace App\Filament\Admin\Resources\Galleries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class GalleriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Works')
                    ->size(72)
                    ->extraImgAttributes([
                        'class' => 'rounded-xl object-cover shadow-sm ring-1 ring-gray-950/5',
                    ])
                    ->grow(false),

                TextColumn::make('title')
                    ->label('Title')
                    ->weight('semibold')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->description(fn ($record) => $record->description
                        ? Str::limit($record->description, 60)
                        : null),

                ToggleColumn::make('is_visible')
                    ->label('Display in Public')
                    ->sortable()
                    ->alignCenter(),

                TextColumn::make('created_at')
                    ->label('Diupload')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->color('gray')
                    ->icon(Heroicon::OutlinedCalendarDays)
                    ->tooltip(fn ($record) => $record->created_at?->diffForHumans())
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_visible')
                    ->label('Visibilitas')
                    ->placeholder('All Images')
                    ->trueLabel('Display in Public')
                    ->falseLabel('Hidden'),
            ])
            ->recordActions([
                EditAction::make()
                    ->iconButton()
                    ->tooltip('Change'),
                DeleteAction::make()
                    ->iconButton()
                    ->tooltip('Delete'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([12, 24, 50])
            ->emptyStateIcon(Heroicon::OutlinedPhoto)
            ->emptyStateHeading('No Image Yet')
            ->emptyStateDescription('Upload your first artwork to start filling the gallery.');
    }
}
