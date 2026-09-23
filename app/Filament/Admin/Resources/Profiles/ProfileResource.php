<?php

namespace App\Filament\Admin\Resources\Profiles;

use App\Filament\Admin\Resources\Profiles\Pages;
use App\Filament\Admin\Resources\Profiles\Schemas\ProfileForm;
use App\Filament\Admin\Resources\Profiles\Tables\ProfilesTable;
use App\Models\Profile;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Schemas\Schema;

class ProfileResource extends Resource
{
    protected static ?string $model = Profile::class;

    // Ikon outline saat tidak aktif, ikon solid saat menu sedang dibuka.
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-circle';
    protected static string|\BackedEnum|null $activeNavigationIcon = 'heroicon-s-user-circle';

    protected static \UnitEnum|string|null $navigationGroup = 'Content';
    protected static ?string $navigationLabel = 'My Profile';
    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'profil';
    protected static ?string $pluralModelLabel = 'profil';

    // Menyembunyikan tombol "Create" jika profil sudah ada (Maksimal 1)
    public static function canCreate(): bool
    {
        return Profile::count() === 0;
    }

    /**
     * Badge kecil di sebelah menu navigasi, menunjukkan status profil
     * tanpa perlu admin membuka halamannya terlebih dahulu.
     */
    public static function getNavigationBadge(): ?string
    {
        return Profile::count() > 0 ? 'Active' : 'Empty';
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return Profile::count() > 0 ? 'success' : 'warning';
    }

    public static function form(Schema $schema): Schema
    {
        return ProfileForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProfilesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfiles::route('/'),
            'create' => Pages\CreateProfile::route('/create'),
            'edit' => Pages\EditProfile::route('/{record}/edit'),
        ];
    }
}
