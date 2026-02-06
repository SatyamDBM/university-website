<?php

namespace App\Filament\Resources\UniversityLeads\Pages;

use App\Filament\Resources\UniversityLeads\UniversityLeadResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUniversityLead extends ViewRecord
{
    protected static string $resource = UniversityLeadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
