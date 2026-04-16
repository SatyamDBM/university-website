<?php

namespace App\Filament\Pages;

use App\Models\AdminFaq;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use UnitEnum;
use BackedEnum;

class CreateAdminFaq extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-plus-circle';

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'Create Admin FAQ';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Create Admin FAQ';

    protected string $view = 'filament.pages.create-admin-faq';

    public $question = '';
    public $answer = '';
    public $sort_order = 0;
    public $is_active = 1;

    public function createAdminFaq(): void
    {
        $this->validate([
            'question'   => ['required', 'string', 'max:255'],
            'answer'     => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_active'  => ['required', 'boolean'],
        ]);

        AdminFaq::create([
            'question'   => $this->question,
            'answer'     => $this->answer,
            'sort_order' => $this->sort_order,
            'is_active'  => $this->is_active,
        ]);

        Notification::make()
            ->title('FAQ created successfully')
            ->success()
            ->send();

        $this->redirect('/admin/all-admin-faqs');
    }
}