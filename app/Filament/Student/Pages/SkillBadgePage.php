<?php

namespace App\Filament\Student\Pages;

use App\Models\Badge;
use App\Enums\BadgeType;
use App\Models\Point;
use App\Models\UserBadge;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On; 
use Filament\Notifications\Notification;

class SkillBadgePage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-check-badge';
    protected static string $view = 'filament.student.pages.skill-badge-page';
    
    public function getUserPoints()
    {
        return Point::where('user_id', Auth::id())->sum('points');
    }

    public function claimBadge($badgeId)
    {
        $badge = Badge::find($badgeId);
        $userPoints = $this->getUserPoints();

        if ($userPoints >= $badge->point_require) {
            UserBadge::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'badge_id' => $badgeId,
                ],
                [
                    'awarded_date' => now(),
                    'is_claimed' => true,
                ]
            );

            Notification::make()
                ->title('Badge claimed successfully')
                ->body("You have claimed the {$badge->name} badge.")
                ->seconds(5)
                ->success()
                ->send();
            $this->dispatch('badge-claimed');
        }
    }

    public function getBadges()
    {
        $userPoints = $this->getUserPoints();
        $badges = Badge::with(['userBadges' => function ($query) {
            $query->where('user_id', Auth::id());
        }])
        ->where('type', 'default')
        ->orWhere(function($query) {
            $query->whereHas('userBadges', function($q) {
            $q->where('user_id', Auth::id())
              ->where('is_claimed', true);
            });
        })
        ->get();

        return $badges->map(function ($badge) use ($userPoints) {
            $userBadge = $badge->userBadges->first();
            return [
                'id' => $badge->id,
                'name' => $badge->name,
                'description' => $badge->description,
                'image' => $badge->image,
                'color' => $badge->color,
                'type' => $badge->type,
                'point_require' => $badge->point_require,
                'is_claimable' => $userPoints >= $badge->point_require,
                'is_claimed' => optional($userBadge)->is_claimed ?? false,
            ];
        });
    }

    public function getPointHistory()
    {
        return Point::where('user_id', Auth::id())
            ->with(['course'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
    }
}
