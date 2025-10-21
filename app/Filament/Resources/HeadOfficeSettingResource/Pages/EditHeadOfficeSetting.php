<?php

namespace App\Filament\Resources\HeadOfficeSettingResource\Pages;

use App\Filament\Resources\HeadOfficeSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHeadOfficeSetting extends EditRecord
{
    protected static string $resource = HeadOfficeSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
