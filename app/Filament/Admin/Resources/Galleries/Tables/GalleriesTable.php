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
                    ->label('Karya')
                    ->size(72)
                    ->extraImgAttributes([
                        'class' => 'rounded-xl object-cover shadow-sm ring-1 ring-gray-950/5',
                    ])
                    ->grow(false),

                TextColumn::make('title')
                    ->label('Judul Lukisan')
                    ->weight('semibold')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->description(fn ($record) => $record->description
                        ? Str::limit($record->description, 60)
                        : null),

                ToggleColumn::make('is_visible')
                    ->label('Tampil di Publik')
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
                    ->placeholder('Semua Lukisan')
                    ->trueLabel('Tampil di Publik')
                    ->falseLabel('Disembunyikan'),
            ])
            ->recordActions([
                EditAction::make()
                    ->iconButton()
                    ->tooltip('Ubah'),
                DeleteAction::make()
                    ->iconButton()
                    ->tooltip('Hapus'),
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
            ->emptyStateHeading('Belum Ada Lukisan')
            ->emptyStateDescription('Unggah karya seni pertama Anda untuk mulai mengisi galeri.');
    }
}
