<?php

namespace App\Filament\Admin\Resources\Certificates\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CertificatesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('')
                    ->square()
                    ->size(56),

                TextColumn::make('name')
                    ->label('Certificate Name')
                    ->weight('bold')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => $record->issuer),

                TextColumn::make('category')
                    ->label('Category')
                    ->badge()
                    ->sortable()
                    ->placeholder('—'),

                TextColumn::make('issue_date')
                    ->label('Issue Date')
                    ->date('d M Y')
                    ->sortable()
                    ->placeholder('—'),

                IconColumn::make('credential_url')
                    ->label('Credential')
                    ->icon('heroicon-o-link')
                    ->color(fn ($state) => filled($state) ? 'primary' : 'gray')
                    ->url(fn ($record) => $record->credential_url, shouldOpenInNewTab: true)
                    ->tooltip(fn ($record) => $record->credential_url ?: 'No credential link available'),

                ToggleColumn::make('is_visible')
                    ->label('Visible'),
            ])
            ->defaultSort('issue_date', 'desc')
            ->filters([
                SelectFilter::make('issuer')
                    ->label('Issuer')
                    ->options(fn () => \App\Models\Certificate::query()
                        ->distinct()
                        ->whereNotNull('issuer')
                        ->pluck('issuer', 'issuer')
                        ->toArray()),

                SelectFilter::make('category')
                    ->label('Category')
                    ->options(fn () => \App\Models\Certificate::query()
                        ->distinct()
                        ->whereNotNull('category')
                        ->pluck('category', 'category')
                        ->toArray()),

                TernaryFilter::make('is_visible')
                    ->label('Display Status'),

                Filter::make('has_image')
                    ->label('Have a picture')
                    ->query(fn (Builder $query) => $query->whereNotNull('image')),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}