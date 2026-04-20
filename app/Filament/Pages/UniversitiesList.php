<?php

namespace App\Filament\Pages;

use App\Models\User;
use UnitEnum;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Mail;
use App\Services\MailConfigurationService;
use App\Mail\UniversityApprovedMail;
use App\Mail\UniversitySuspendedMail;
use App\Mail\UniversityActivatedMail;
use App\Mail\UniversityBlockedMail;
use App\Mail\UniversityDeletedMail;

class UniversitiesList extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationLabel = 'Universities List';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';

    protected static string|UnitEnum|null $navigationGroup = 'Universities';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.universities-list';

    public function table(Table $table): Table
    {
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'admin';
    }
}