<?php

namespace App\Filament\Resources\CmsPages\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class CmsPagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->heading('CMS Pages List')

            ->description('Manage all CMS pages from here.')

            ->striped()

            ->paginated([10, 25, 50])

            ->defaultSort('updated_at', 'desc')

            ->columns([
                TextColumn::make('title')
                    ->label('Page Title')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold')
                    ->color('primary')
                    ->extraAttributes([
                        'class' => 'text-sm',
                    ]),

                TextColumn::make('slug')
                    ->label('Slug')
                    ->copyable()
                    ->toggleable()
                    ->badge()
                    ->color('gray')
                    ->extraAttributes([
                        'class' => 'font-mono text-xs',
                    ]),

                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('d M Y, h:i A')
                    ->sortable()
                    ->color('gray')
                    ->extraAttributes([
                        'class' => 'text-xs',
                    ]),
            ]);
    }
}