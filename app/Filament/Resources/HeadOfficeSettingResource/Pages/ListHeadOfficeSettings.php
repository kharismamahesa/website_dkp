<?php

namespace App\Filament\Resources\HeadOfficeSettingResource\Pages;

use App\Filament\Resources\HeadOfficeSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHeadOfficeSettings extends ListRecords
{
    protected static string $resource = HeadOfficeSettingResource::class;

    protected function getHeaderActions(): array
    {
        // return [
        //     Actions\CreateAction::make(),
        // ];
        return \App\Models\HeadOfficeSetting::count() === 0
            ? [Actions\CreateAction::make()]
            : [];
    }
}
