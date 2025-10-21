<?php

namespace App\Filament\Resources\RegulationCategoryResource\Pages;

use App\Filament\Resources\RegulationCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRegulationCategories extends ListRecords
{
    protected static string $resource = RegulationCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
