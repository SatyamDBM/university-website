<?php

namespace App\Filament\Resources\LeadDistributions\Pages;

use App\Filament\Resources\LeadDistributions\LeadDistributionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLeadDistribution extends ViewRecord
{
    protected static string $resource = LeadDistributionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
