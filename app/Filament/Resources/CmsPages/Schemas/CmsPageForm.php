<?php

namespace App\Filament\Resources\CmsPages\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CmsPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            TextInput::make('title')
                ->label('Title')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(function ($state, callable $set) {
                    $set('slug', Str::slug($state));
                }),

            TextInput::make('slug')
                ->label('Slug')
                ->required()
                ->helperText('URL-friendly version of the title (auto-generated)')
                ->unique(ignoreRecord: true),

            RichEditor::make('content')
                ->label('Content')
                ->required()
                ->columnSpanFull()
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'underline',
                    'bulletList',
                    'orderedList',
                    'link',
                    'blockquote',
                    'h2',
                    'h3',
                    'undo',
                    'redo',
                ]),

            TextInput::make('seo_title')
                ->label('SEO Title')
                ->maxLength(60)
                ->helperText('Recommended max 60 characters'),

            Textarea::make('seo_description')
                ->label('SEO Description')
                ->maxLength(160)
                ->helperText('Recommended max 160 characters')
                ->columnSpanFull(),

            Toggle::make('is_active')
                ->label('Is Active')
                ->default(true),
        ]);
    }
}
