<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use UnitEnum;
use BackedEnum;

class CreateBlog extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-plus-circle';

    protected static string|UnitEnum|null $navigationGroup = 'Blogs';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Create Blog';

    protected static ?string $title = 'Create Blog';

    protected string $view = 'filament.pages.create-blog';
}