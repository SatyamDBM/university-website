<?php

namespace App\Filament\Pages;

use App\Models\AdminFaq;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use UnitEnum;
use BackedEnum;

class EditAdminFaq extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-pencil-square';

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'Edit Admin FAQ';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Edit Admin FAQ';

    protected string $view = 'filament.pages.edit-admin-faq';

    public ?AdminFaq $faq = null;

    public $faq_id;
    public $question = '';
    public $answer = '';
    public $sort_order = 0;
    public $is_active = 1;

    public function mount(): void
    {
        $id = request()->query('id');

        $this->faq = AdminFaq::findOrFail($id);

        $this->faq_id = $this->faq->id;
        $this->question = $this->faq->question;
        $this->answer = $this->faq->answer;
        $this->sort_order = $this->faq->sort_order;
        $this->is_active = $this->faq->is_active;
    }

    public function updateAdminFaq(): void
    {
        $this->validate([
            'question'   => ['required', 'string', 'max:255'],
            'answer'     => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_active'  => ['required', 'boolean'],
        ]);

        $this->faq->update([
            'question'   => $this->question,
            'answer'     => $this->answer,
            'sort_order' => $this->sort_order,
            'is_active'  => $this->is_active,
        ]);

        Notification::make()
            ->title('FAQ updated successfully')
            ->success()
            ->send();

        $this->redirect('/admin/all-admin-faqs');
    }
}