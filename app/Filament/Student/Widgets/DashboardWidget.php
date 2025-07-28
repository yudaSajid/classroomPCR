<?php

namespace App\Filament\Student\Widgets;

use App\Models\User;
use App\Models\UserEducation;
use App\Models\UserInformation;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class DashboardWidget extends Widget
{
    protected int|string|array $columnSpan = 'full';

    protected static string $view = 'filament.student.widgets.dashboard-widget';

    public bool $hasUserInfo = false;

    public bool $hasUserEdu = false;

    public ?User $user = null;

    public function mount(): void
    {
        // Cek apakah user yang login memiliki data UserInformation
        $this->hasUserInfo = UserInformation::where('user_id', Auth::id())->exists();
        $this->hasUserEdu = UserEducation::where('user_id', Auth::id())->exists();

        // Jika `hasUserInfo` bernilai true, set data user
        if ($this->hasUserInfo || $this->hasUserEdu) {
            $this->user = Auth::user();
        }
    }
}
