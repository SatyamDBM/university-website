<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use UnitEnum;
use BackedEnum;

class EditStaff extends Page
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Edit Staff';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-pencil-square';
    protected static ?string $slug = 'edit-staff/{id}';

    protected string $view = 'filament.pages.edit-staff';

    public $staff;
    public $name;
    public $email;
    public $mobile;
    public $password;
    public $confirm_password;
    public $status;

    public function mount($id): void
    {
        $this->staff = User::where('role', 'staff')->findOrFail($id);

        $this->name = $this->staff->name;
        $this->email = $this->staff->email;
        $this->mobile = $this->staff->mobile;
        $this->status = $this->staff->status;
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->staff->id),
            ],
            'mobile' => ['nullable', 'digits:10'],
            'password' => ['nullable', 'min:6'],
            'confirm_password' => ['nullable', 'same:password'],
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
            'password.min' => 'Password must be at least 6 characters.',
            'confirm_password.same' => 'Password and confirm password must match.',
            'status.required' => 'Status is required.',
        ];
    }

    public function updateStaff()
    {
        $this->validate();

        $updateData = [
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'status' => $this->status,
        ];

        if (!empty($this->password)) {
            $updateData['password'] = Hash::make($this->password);
        }

        $this->staff->update($updateData);

        Notification::make()
            ->title('Staff updated successfully')
            ->success()
            ->send();

        return redirect('/admin/all-staff');
    }
}