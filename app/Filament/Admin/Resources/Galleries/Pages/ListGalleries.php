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
                ->label('Add Image'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),

            'visible' => Tab::make('Display in Public')
                ->modifyQueryUsing(fn ($query) => $query->where('is_visible', true)),

            'hidden' => Tab::make('Hidden')
                ->modifyQueryUsing(fn ($query) => $query->where('is_visible', false)),
        ];
    }
}