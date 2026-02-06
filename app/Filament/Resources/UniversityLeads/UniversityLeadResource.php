<?php

namespace App\Filament\Resources\UniversityLeads;

use App\Filament\Resources\UniversityLeads\Pages\CreateUniversityLead;
use App\Filament\Resources\UniversityLeads\Pages\EditUniversityLead;
use App\Filament\Resources\UniversityLeads\Pages\ListUniversityLeads;
use App\Filament\Resources\UniversityLeads\Pages\ViewUniversityLead;
use App\Filament\Resources\UniversityLeads\Schemas\UniversityLeadForm;
use App\Filament\Resources\UniversityLeads\Schemas\UniversityLeadInfolist;
use App\Filament\Resources\UniversityLeads\Tables\UniversityLeadsTable;
use App\Models\UniversityLead;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UniversityLeadResource extends Resource
{
    protected static ?string $model = UniversityLead::class;
    protected static string|UnitEnum|null $navigationGroup = 'Leads';
    protected static ?string $navigationLabel = 'University Leads';
    protected static ?int $navigationSort = 2;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return UniversityLeadForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UniversityLeadInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UniversityLeadsTable::configure($table);
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
            'index' => ListUniversityLeads::route('/'),
            'create' => CreateUniversityLead::route('/create'),
            'view' => ViewUniversityLead::route('/{record}'),
            'edit' => EditUniversityLead::route('/{record}/edit'),
        ];
    }
}
