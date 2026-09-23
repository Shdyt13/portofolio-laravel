<?php

namespace App\Filament\Admin\Resources\Services\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                IconColumn::make('icon')
                    ->label('')
                    ->icon(fn (?string $state) => filled($state) ? $state : 'heroicon-o-briefcase')
                    ->color('primary')
                    ->size('lg'),

                TextColumn::make('name')
                    ->label('Nama Layanan')
                    ->weight('bold')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => str($record->description ?? '')->limit(50)),

                // Sebelumnya kolom ini masih memakai nama field lama 'fee',
                // padahal form & model sudah memakai 'price' — menyebabkan
                // error "Unknown column 'fee'" saat halaman list dibuka.
                TextColumn::make('price')
                    ->label('Tarif')
                    ->badge()
                    ->color('success')
                    ->searchable()
                    ->placeholder('—'),

                TextColumn::make('display_order')
                    ->label('Urutan')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                ToggleColumn::make('is_visible')
                    ->label('Tampil'),
            ])
            ->defaultSort('display_order')
            ->reorderable('display_order')
            ->filters([
                TernaryFilter::make('is_visible')
                    ->label('Status Tampil'),
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
