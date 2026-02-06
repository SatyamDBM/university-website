<?php

namespace App\Filament\Resources\LeadDistributions\Pages;

use App\Filament\Resources\LeadDistributions\LeadDistributionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLeadDistributions extends ListRecords
{
    protected static string $resource = LeadDistributionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
