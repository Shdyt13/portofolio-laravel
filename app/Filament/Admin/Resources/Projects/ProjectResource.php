<?php

namespace App\Filament\Admin\Resources\Projects;

use App\Filament\Admin\Resources\Projects\Pages\CreateProject;
use App\Filament\Admin\Resources\Projects\Pages\EditProject;
use App\Filament\Admin\Resources\Projects\Pages\ListProjects;
use App\Filament\Admin\Resources\Projects\Schemas\ProjectForm;
use App\Filament\Admin\Resources\Projects\Tables\ProjectsTable;
use App\Models\Project;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    // Ikon outline untuk kondisi normal, filled otomatis dipakai saat menu aktif.
    // "Folder Open" lebih merepresentasikan kumpulan Project dibanding RectangleStack.
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFolderOpen;

    protected static string|BackedEnum|null $activeNavigationIcon = Heroicon::FolderOpen;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Projects';

    protected static ?int $navigationSort = 3;

    // Perbaikan tipe data di baris ini:
    protected static \UnitEnum|string|null $navigationGroup = 'Content';

    public static function form(Schema $schema): Schema
    {
        return ProjectForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProjectsTable::configure($table);
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
            'index' => ListProjects::route('/'),
            'create' => CreateProject::route('/create'),
            'edit' => EditProject::route('/{record}/edit'),
        ];
    }

    // Badge angka di sidebar menampilkan jumlah project yang sedang tampil (is_visible = true)
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('is_visible', true)->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
    }
}
