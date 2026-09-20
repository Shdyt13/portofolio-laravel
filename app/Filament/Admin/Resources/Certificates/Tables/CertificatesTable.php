<?php

namespace App\Filament\Admin\Resources\Certificates\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
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
                    ->label('Nama Sertifikat')
                    ->weight('bold')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => $record->issuer),

                TextColumn::make('date')
                    ->label('Tanggal Terbit')
                    ->date('d M Y')
                    ->sortable()
                    ->placeholder('—'),

                IconColumn::make('file_url')
                    ->label('Kredensial')
                    ->icon('heroicon-o-link')
                    ->color(fn ($state) => filled($state) ? 'primary' : 'gray')
                    ->url(fn ($record) => $record->file_url, shouldOpenInNewTab: true)
                    ->tooltip(fn ($record) => $record->file_url ?: 'Belum ada tautan kredensial'),
            ])
            ->defaultSort('date', 'desc')
            ->filters([
                SelectFilter::make('issuer')
                    ->label('Penerbit')
                    ->options(fn () => \App\Models\Certificate::query()
                        ->distinct()
                        ->whereNotNull('issuer')
                        ->pluck('issuer', 'issuer')
                        ->toArray()),

                Filter::make('has_image')
                    ->label('Punya gambar')
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
