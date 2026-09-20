<?php

namespace App\Filament\Admin\Resources\Profiles\Pages;

use App\Filament\Admin\Resources\Profiles\ProfileResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProfile extends CreateRecord
{
    protected static string $resource = ProfileResource::class;

    protected function getRedirectUrl(): string
    {
        // Setelah profil pertama kali dibuat, tetap di form Edit
        // (bukan balik ke halaman tabel) supaya admin bisa langsung
        // melanjutkan mengisi/meninjau data.
        return static::getResource()::getUrl('edit', ['record' => $this->getRecord()]);
    }
}
