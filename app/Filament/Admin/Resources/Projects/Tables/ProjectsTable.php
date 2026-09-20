<?php

namespace App\Filament\Admin\Resources\Projects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('')
                    ->square()
                    ->size(56),

                TextColumn::make('name')
                    ->label('Project')
                    ->weight('bold')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => str($record->description)->limit(50)),

                // Menampilkan nama skill yang berelasi dalam bentuk badge (label kecil)
                TextColumn::make('skills.name')
                    ->label('Skills')
                    ->badge()
                    ->color('info')
                    ->separator(',')
                    ->searchable()
                    ->limitList(3)
                    ->expandableLimitedList(),

                TextColumn::make('status')
                    ->badge()
                    ->searchable()
                    ->color(fn (?string $state) => match ($state) {
                        'completed' => 'success',
                        'in_progress' => 'warning',
                        'archived' => 'gray',
                        'draft' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (?string $state) => $state ? str($state)->replace('_', ' ')->title() : '—'),

                IconColumn::make('github_url')
                    ->label('Repo')
                    ->icon('heroicon-o-code-bracket')
                    ->color(fn ($state) => filled($state) ? 'primary' : 'gray')
                    ->url(fn ($record) => $record->github_url, shouldOpenInNewTab: true)
                    ->tooltip(fn ($record) => $record->github_url ?: 'Belum ada tautan repo'),

                IconColumn::make('demo_url')
                    ->label('Demo')
                    ->icon('heroicon-o-globe-alt')
                    ->color(fn ($state) => filled($state) ? 'primary' : 'gray')
                    ->url(fn ($record) => $record->demo_url, shouldOpenInNewTab: true)
                    ->tooltip(fn ($record) => $record->demo_url ?: 'Belum ada tautan demo'),

                ToggleColumn::make('featured')
                    ->label('Featured'),

                ToggleColumn::make('is_visible')
                    ->label('Visible'),

                TextColumn::make('display_order')
                    ->label('Urutan')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('display_order')
            ->reorderable('display_order')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'in_progress' => 'In Progress',
                        'completed' => 'Completed',
                        'archived' => 'Archived',
                    ]),

                TernaryFilter::make('featured'),
                TernaryFilter::make('is_visible')
                    ->label('Visible'),
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
