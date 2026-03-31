<?php

namespace App\Filament\Resources\CmsPages\Pages;

use App\Filament\Resources\CmsPages\CmsPageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;

class ListCmsPages extends ListRecords
{
    protected static string $resource = CmsPageResource::class;

    public function table(Table $table): Table
    {
        return CmsPageResource::table($table)
            ->heading('CMS Pages List')
            ->description('Manage all CMS pages from here.');
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('New cms page'),
        ];
    }
}