<?php

namespace App\Filament\Admin\Resources\AdditionalSkills\Pages;

use App\Filament\Admin\Resources\AdditionalSkills\AdditionalSkillResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAdditionalSkills extends ListRecords
{
    protected static string $resource = AdditionalSkillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
