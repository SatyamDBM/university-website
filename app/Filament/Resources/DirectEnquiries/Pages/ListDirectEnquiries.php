<?php

namespace App\Filament\Resources\DirectEnquiries\Pages;

use App\Filament\Resources\DirectEnquiries\DirectEnquiryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDirectEnquiries extends ListRecords
{
    protected static string $resource = DirectEnquiryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
