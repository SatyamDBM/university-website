<?php

namespace App\Filament\Resources\DirectEnquiries\Pages;

use App\Filament\Resources\DirectEnquiries\DirectEnquiryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDirectEnquiry extends ViewRecord
{
    protected static string $resource = DirectEnquiryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
