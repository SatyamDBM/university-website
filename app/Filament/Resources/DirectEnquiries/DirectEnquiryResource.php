<?php

namespace App\Filament\Resources\DirectEnquiries;

use App\Filament\Resources\DirectEnquiries\Pages\CreateDirectEnquiry;
use App\Filament\Resources\DirectEnquiries\Pages\EditDirectEnquiry;
use App\Filament\Resources\DirectEnquiries\Pages\ListDirectEnquiries;
use App\Filament\Resources\DirectEnquiries\Pages\ViewDirectEnquiry;
use App\Filament\Resources\DirectEnquiries\Schemas\DirectEnquiryForm;
use App\Filament\Resources\DirectEnquiries\Schemas\DirectEnquiryInfolist;
use App\Filament\Resources\DirectEnquiries\Tables\DirectEnquiriesTable;
use App\Models\DirectEnquiry;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DirectEnquiryResource extends Resource
{
    protected static ?string $model = DirectEnquiry::class;
    protected static string|UnitEnum|null $navigationGroup = 'Leads';
    protected static ?string $navigationLabel = 'Direct Enquiries';
    protected static ?int $navigationSort = 2;


    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return DirectEnquiryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DirectEnquiryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DirectEnquiriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDirectEnquiries::route('/'),
            'create' => CreateDirectEnquiry::route('/create'),
            'view' => ViewDirectEnquiry::route('/{record}'),
            'edit' => EditDirectEnquiry::route('/{record}/edit'),
        ];
    }
}
