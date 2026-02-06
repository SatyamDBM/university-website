<?php

namespace App\Filament\Resources\UniversityLeads\Pages;

use App\Filament\Resources\UniversityLeads\UniversityLeadResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditUniversityLead extends EditRecord
{
    protected static string $resource = UniversityLeadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
