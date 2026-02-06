<?php

namespace App\Filament\Resources\DirectEnquiries\Pages;

use App\Filament\Resources\DirectEnquiries\DirectEnquiryResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditDirectEnquiry extends EditRecord
{
    protected static string $resource = DirectEnquiryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
