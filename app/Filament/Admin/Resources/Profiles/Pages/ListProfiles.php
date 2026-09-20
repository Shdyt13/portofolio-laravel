<?php

namespace App\Filament\Admin\Resources\Profiles\Pages;

use App\Filament\Admin\Resources\Profiles\ProfileResource;
use App\Models\Profile;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProfiles extends ListRecords
{
    protected static string $resource = ProfileResource::class;

    /**
     * Profil bersifat singleton (maksimal 1 data). Supaya navigasi terasa
     * rapi dan sesuai konteksnya, klik menu "Profil Saya" langsung membawa
     * admin ke form Edit (jika data sudah ada) atau form Create (jika
     * belum), tanpa perlu singgah dulu di halaman tabel yang isinya cuma
     * satu baris.
     */
    public function mount(): void
    {
        parent::mount();

        $profile = Profile::first();

        redirect(
            $profile
                ? ProfileResource::getUrl('edit', ['record' => $profile])
                : ProfileResource::getUrl('create')
        );
    }

    protected function getHeaderActions(): array
    {
        return [
            ...Profile::count() === 0
                ? [CreateAction::make()->label('Buat Profil')]
                : [],
        ];
    }
}
