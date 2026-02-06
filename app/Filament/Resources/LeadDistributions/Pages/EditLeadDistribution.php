<?php

namespace App\Filament\Resources\LeadDistributions\Pages;

use App\Filament\Resources\LeadDistributions\LeadDistributionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditLeadDistribution extends EditRecord
{
    protected static string $resource = LeadDistributionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
