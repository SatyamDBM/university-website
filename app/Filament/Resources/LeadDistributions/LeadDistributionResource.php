<?php

namespace App\Filament\Resources\LeadDistributions;

use App\Filament\Resources\LeadDistributions\Pages\CreateLeadDistribution;
use App\Filament\Resources\LeadDistributions\Pages\EditLeadDistribution;
use App\Filament\Resources\LeadDistributions\Pages\ListLeadDistributions;
use App\Filament\Resources\LeadDistributions\Pages\ViewLeadDistribution;
use App\Filament\Resources\LeadDistributions\Schemas\LeadDistributionForm;
use App\Filament\Resources\LeadDistributions\Schemas\LeadDistributionInfolist;
use App\Filament\Resources\LeadDistributions\Tables\LeadDistributionsTable;
use App\Models\LeadDistribution;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LeadDistributionResource extends Resource
{
    protected static ?string $model = LeadDistribution::class;
    protected static string|UnitEnum|null $navigationGroup = 'Leads';
    protected static ?string $navigationLabel = 'Lead Distribution';
    protected static ?int $navigationSort = 5;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return LeadDistributionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LeadDistributionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LeadDistributionsTable::configure($table);
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
            'index' => ListLeadDistributions::route('/'),
            'create' => CreateLeadDistribution::route('/create'),
            'view' => ViewLeadDistribution::route('/{record}'),
            'edit' => EditLeadDistribution::route('/{record}/edit'),
        ];
    }
}
