<?php

namespace App\Filament\Admin\Resources\SoftSkills\Pages;

use App\Filament\Admin\Resources\SoftSkills\SoftSkillResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSoftSkills extends ListRecords
{
    protected static string $resource = SoftSkillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
