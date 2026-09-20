<?php

namespace App\Filament\Admin\Resources\SoftSkills\Pages;

use App\Filament\Admin\Resources\SoftSkills\SoftSkillResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSoftSkill extends EditRecord
{
    protected static string $resource = SoftSkillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
