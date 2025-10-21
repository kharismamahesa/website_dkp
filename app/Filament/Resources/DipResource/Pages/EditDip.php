<?php

namespace App\Filament\Resources\DipResource\Pages;

use App\Filament\Resources\DipResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDip extends EditRecord
{
    protected static string $resource = DipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
