<?php

namespace App\Filament\Admin\Resources\AdditionalSkills\Pages;

use App\Filament\Admin\Resources\AdditionalSkills\AdditionalSkillResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAdditionalSkill extends EditRecord
{
    protected static string $resource = AdditionalSkillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
