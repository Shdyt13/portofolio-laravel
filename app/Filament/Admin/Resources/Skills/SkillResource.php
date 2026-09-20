<?php

namespace App\Filament\Admin\Resources\Skills;

use App\Filament\Admin\Resources\Skills\Pages\CreateSkill;
use App\Filament\Admin\Resources\Skills\Pages\EditSkill;
use App\Filament\Admin\Resources\Skills\Pages\ListSkills;
use App\Filament\Admin\Resources\Skills\Schemas\SkillForm;
use App\Filament\Admin\Resources\Skills\Tables\SkillsTable;
use App\Models\Skill;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;

    // Ikon outline saat menu tidak aktif, solid saat sedang dibuka.
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|BackedEnum|null $activeNavigationIcon = Heroicon::RectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    protected static \UnitEnum|string|null $navigationGroup = 'Content';
    protected static ?string $navigationLabel = 'Skills';
    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'skill';
    protected static ?string $pluralModelLabel = 'skills';

    /**
     * Menampilkan jumlah skill yang sudah diinput di sebelah menu navigasi.
     */
    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 0 ? 'success' : 'gray';
    }

    public static function form(Schema $schema): Schema
    {
        return SkillForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SkillsTable::configure($table);
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
            'index' => ListSkills::route('/'),
            'create' => CreateSkill::route('/create'),
            'edit' => EditSkill::route('/{record}/edit'),
        ];
    }
}
