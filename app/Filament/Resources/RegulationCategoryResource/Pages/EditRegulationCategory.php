<?php

namespace App\Filament\Resources\RegulationCategoryResource\Pages;

use App\Filament\Resources\RegulationCategoryResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\QueryException;

class EditRegulationCategory extends EditRecord
{
    protected static string $resource = RegulationCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
