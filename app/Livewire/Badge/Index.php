<?php

namespace App\Livewire\Badge;

use App\Models\Badge;
use App\Models\User;
use App\Models\UserBadge;
use App\Enums\BadgeType;
use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;

class Index extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];
    public $selectedBadge = null;
    public $selectedUser = null;
    public $users;
    public $badges;
    public $search = ''; // Add search property
    public $isModalOpen = false;
    public $selectedBadgeForView = null;
    public $showRecipients = false;

    public function mount(): void
    {
        $this->users = User::all();
        $this->badges = collect();
        $this->loadBadges();
        $this->form->fill();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->form->fill();
    }

    public function viewBadgeRecipients($badgeId)
    {
        $this->selectedBadgeForView = Badge::with(['userBadges.user'])->find($badgeId);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->minLength(3),
                Textarea::make('description')
                    ->required(),
                    ColorPicker::make('color')
                    ->required(),
                FileUpload::make('image')
                    ->image()
                    ->imageEditor()
                    ->directory('badges')
                    ->required(),
            ])
            ->statePath('data');
    }

    public function createBadge(): void
    {
        $data = $this->form->getState();

        Badge::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'image' => $data['image'],
            'color' => $data['color'],
            'type' => BadgeType::Custom,
        ]);

        $this->closeModal();
        $this->loadBadges();

        Notification::make()
            ->title('Badge created successfully')
            ->success()
            ->send();
    }

    public function selectBadge($badgeId)
    {
        $this->selectedBadge = Badge::find($badgeId);
        $this->selectedUser = null;
    }

    public function assignBadge()
    {
        if (!$this->selectedBadge || !$this->selectedUser) {
            Notification::make()
                ->title('Please select both badge and user')
                ->warning()
                ->send();
            return;
        }

        UserBadge::create([
            'user_id' => $this->selectedUser,
            'badge_id' => $this->selectedBadge->id,
            'awarded_date' => now(),
            'is_claimed' => true,
        ]);

        $this->selectedBadge = null;
        $this->selectedUser = null;

        Notification::make()
            ->title('Badge assigned successfully')
            ->success()
            ->send();
    }

    public function loadBadges()
    {
        try {
            $this->badges = Badge::where('type', BadgeType::Custom)->get();
        } catch (\Exception $e) {
            $this->badges = collect(); // Fallback to empty collection
            session()->flash('error', 'Failed to load badges.');
        }
    }

    public function getFilteredUsersProperty()
    {
        return $this->users->filter(function ($user) {
            return str_contains(strtolower($user->name), strtolower($this->search));
        })->values();
    }

    public function toggleRecipients()
    {
        $this->showRecipients = !$this->showRecipients;
        if ($this->showRecipients) {
            $this->selectedBadge = null;
        }
    }

    public function getRecipientsProperty()
    {
        return UserBadge::with(['user', 'badge'])
            ->whereHas('badge', fn($query) => $query->where('type', BadgeType::Custom))
            ->latest('awarded_date')
            ->get();
    }

    public function toggleClaimed($userBadgeId)
    {
        $userBadge = UserBadge::find($userBadgeId);
        $userBadge->update(['is_claimed' => !$userBadge->is_claimed]);

        Notification::make()
            ->title('Badge status updated')
            ->success()
            ->send();
    }

    public function clearSelectedBadge()
    {
        $this->selectedBadge = null;
        $this->selectedUser = null;
        $this->search = '';
    }

    public function render()
    {
        return view('livewire.badge.index', [
            'filteredUsers' => $this->filteredUsers,
            'recipients' => $this->showRecipients ? $this->recipients : collect(),
        ]);
    }
}
