<?php

namespace App\Filament\Admin\Resources\Profiles\Pages;

use App\Filament\Admin\Resources\Profiles\ProfileResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProfile extends EditRecord
{
    protected static string $resource = ProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('viewSite')
                ->label('Lihat Halaman Depan')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->color('gray')
                ->url('/')
                ->openUrlInNewTab(),

            DeleteAction::make()
                ->label('Hapus Profil'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        // Tetap di form Edit setelah menyimpan, bukan kembali ke tabel.
        return static::getResource()::getUrl('edit', ['record' => $this->getRecord()]);
    }
}
