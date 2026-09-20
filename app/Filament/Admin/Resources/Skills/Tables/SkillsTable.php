<?php

namespace App\Filament\Admin\Resources\Skills\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SkillsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Logo')
                    ->square()
                    ->size(40)
                    ->defaultImageUrl(fn () => 'https://ui-avatars.com/api/?name=Skill&color=7F9CF5&background=EBF4FF'),

                TextColumn::make('name')
                    ->label('Nama Skill')
                    ->weight('semibold')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->since()
                    ->dateTimeTooltip()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->alignEnd(),
            ])
            ->defaultSort('name')
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateIcon('heroicon-o-rectangle-stack')
            ->emptyStateHeading('Belum ada skill')
            ->emptyStateDescription('Tambahkan skill agar tampil sebagai daftar keahlian di halaman depan.');
    }
}
