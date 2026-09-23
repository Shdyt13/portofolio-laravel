<?php

namespace App\Filament\Admin\Resources\Galleries\Pages;

use App\Filament\Admin\Resources\Galleries\GalleryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab; // <-- Ini letak komponen Tab yang baru

class ListGalleries extends ListRecords
{
    protected static string $resource = GalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Lukisan'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua'),

            'visible' => Tab::make('Tampil di Publik')
                ->modifyQueryUsing(fn ($query) => $query->where('is_visible', true)),

            'hidden' => Tab::make('Disembunyikan')
                ->modifyQueryUsing(fn ($query) => $query->where('is_visible', false)),
        ];
    }
}