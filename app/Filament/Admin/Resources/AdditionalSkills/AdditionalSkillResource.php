<?php

namespace App\Filament\Admin\Resources\AdditionalSkills;

use App\Filament\Admin\Resources\AdditionalSkills\Pages\CreateAdditionalSkill;
use App\Filament\Admin\Resources\AdditionalSkills\Pages\EditAdditionalSkill;
use App\Filament\Admin\Resources\AdditionalSkills\Pages\ListAdditionalSkills;
use App\Filament\Admin\Resources\AdditionalSkills\Schemas\AdditionalSkillForm;
use App\Filament\Admin\Resources\AdditionalSkills\Tables\AdditionalSkillsTable;
use App\Models\AdditionalSkill;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AdditionalSkillResource extends Resource
{
    protected static ?string $model = AdditionalSkill::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    protected static string|\UnitEnum|null $navigationGroup = 'Content';

    public static function form(Schema $schema): Schema
    {
        return AdditionalSkillForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AdditionalSkillsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAdditionalSkills::route('/'),
            'create' => CreateAdditionalSkill::route('/create'),
            'edit' => EditAdditionalSkill::route('/{record}/edit'),
        ];
    }
}
