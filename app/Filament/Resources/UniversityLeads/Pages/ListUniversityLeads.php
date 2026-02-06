<?php

namespace App\Filament\Resources\UniversityLeads\Pages;

use App\Filament\Resources\UniversityLeads\UniversityLeadResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUniversityLeads extends ListRecords
{
    protected static string $resource = UniversityLeadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
