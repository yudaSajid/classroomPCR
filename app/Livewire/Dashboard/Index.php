<?php

namespace App\Livewire\Dashboard;

use App\Models\Classroom;
use App\Models\ClassroomUser;
use App\Models\Point as Points;
use App\Models\UserBadge;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Filament\Notifications\Notification;

class Index extends Component
{
    public $points;
    public $user;
    public $badgeCount;
    public $classCode = '';
    public $showRedeemModal = false;

    protected $rules = [
        'classCode' => 'required|string|min:6|max:6'
    ];

    protected $messages = [
        'classCode.required' => 'Please enter a class code',
        'classCode.min' => 'Class code must be 6 characters',
        'classCode.max' => 'Class code must be 6 characters'
    ];

    public function mount()
    {
        $this->user = Auth::id();
        $this->points = $this->formatPoints(
            Points::where('user_id', $this->user)
                ->sum('points')
        );
        $this->badgeCount = UserBadge::where('user_id', $this->user)
            ->where('is_claimed', true)
            ->count();
    }

    public function getEnrolledClassroomsProperty()
    {
        return ClassroomUser::with(['classroom.program'])
            ->where('user_id', $this->user)
            ->get();
    }

    private function formatPoints($points)
    {
        if ($points < 1000) {
            return $points . ' pts';
        } elseif ($points < 10000) {
            return number_format($points / 1000, 1) . ' Grand';
        } elseif ($points < 1000000) {
            return number_format($points / 1000, 0) . ' Kilo';
        } elseif ($points < 1000000000) {
            return number_format($points / 1000000, 1) . ' Mega';
        } else {
            return number_format($points / 1000000000, 1) . ' Ultra';
        }
    }

    public function redeemCode()
    {
        $this->validate();

        $classroom = Classroom::where('class_code', strtoupper($this->classCode))->first();

        if (!$classroom) {
            Notification::make()
                ->title('Invalid Code')
                ->danger()
                ->body('The class code you entered is invalid.')
                ->send();
            return;
        }

        // Check if user already enrolled
        $exists = ClassroomUser::where('classroom_id', $classroom->id)
            ->where('user_id', $this->user)
            ->exists();

        if ($exists) {
            Notification::make()
                ->title('Already Enrolled')
                ->warning()
                ->body('You are already enrolled in this class.')
                ->send();
            return;
        }

        // Enroll user
        ClassroomUser::create([
            'classroom_id' => $classroom->id,
            'user_id' => $this->user
        ]);

        // Reset form
        $this->reset('classCode');
        $this->showRedeemModal = false;

        // Show success notification
        Notification::make()
            ->title('Enrollment Successful')
            ->success()
            ->body("You have successfully enrolled in {$classroom->class_name}")
            ->duration(5000) // Show for 5 seconds
            ->send();
    }

    public function render()
    {
        return view('livewire.dashboard.index', [
            'enrolledClassrooms' => $this->enrolledClassrooms
        ]);
    }
}
