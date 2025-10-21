<?php

namespace App\Filament\Resources\DipResource\Pages;

use App\Filament\Resources\DipResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDips extends ListRecords
{
    protected static string $resource = DipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
