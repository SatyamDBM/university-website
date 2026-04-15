<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use UnitEnum;
use BackedEnum;

class CreateStaff extends Page
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Create Staff';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-plus';

    protected string $view = 'filament.pages.create-staff';

    public $name;
    public $email;
    public $mobile;
    public $password;
    public $confirm_password;
    public $status = 'active';

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'mobile' => ['nullable', 'digits:10'],
            'password' => ['required', 'min:6'],
            'confirm_password' => ['required', 'same:password'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ];
    }

    protected function messages(): array
    {
        return [
            'name.required' => 'Staff name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Enter a valid email address.',
            'email.unique' => 'This email already exists.',
            'mobile.digits' => 'Mobile number must be 10 digits.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters.',
            'confirm_password.required' => 'Confirm password is required.',
            'confirm_password.same' => 'Password and confirm password must match.',
            'status.required' => 'Status is required.',
        ];
    }

    public function createStaff()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'password' => Hash::make($this->password),
            'role' => 'staff',
            'status' => $this->status,
        ]);

        Notification::make()
            ->title('Staff created successfully')
            ->success()
            ->send();

        return redirect('/admin/all-staff');
    }
}