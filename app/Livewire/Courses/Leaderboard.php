<?php

namespace App\Livewire\Courses;

use App\Models\Course;
use App\Models\Point;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Leaderboard extends Component
{
    public $courseID;

    public $courseName;

    public $topPoints;

    public $currentUserRank;

    public $currentUserPoints;

    public function mount($courseID)
    {
        $this->courseID = $courseID;
        $currentUserId = Auth::id();

        $course = Course::find($this->courseID);
        $this->courseName = $course ? $course->course_name : 'this course';

        $this->topPoints = Point::where('course_id', $this->courseID)
            ->groupBy('user_id')
            ->selectRaw('user_id, SUM(points) as total_points')
            ->orderBy('total_points', 'desc')
            ->take(5)
            ->get();

        $this->topPoints = $this->topPoints->map(function ($point) {
            $user = User::find($point->user_id);
            $point->name = $user->name;
            $point->avatar = $user->profile_photo_url;
            $point->formatted_points = $this->formatPoints($point->total_points);

            return $point;
        });

        $allPoints = Point::where('course_id', $this->courseID)
            ->groupBy('user_id')
            ->select('user_id', DB::raw('SUM(points) as total_points'))
            ->orderBy('total_points', 'desc')
            ->get();

        $userRank = $allPoints->search(function ($point) use ($currentUserId) {
            return $point->user_id == $currentUserId;
        });

        if ($userRank !== false) {
            $this->currentUserRank = $userRank + 1;
            $this->currentUserPoints = $allPoints[$userRank]->total_points;
        } else {
            $this->currentUserRank = null;
            $this->currentUserPoints = 0;
        }
    }

    private function formatPoints($points)
    {
        if ($points < 1000) {
            return $points;
        } elseif ($points < 1000000) {
            return number_format($points / 1000, 0).'K';
        } elseif ($points < 1000000000) {
            return number_format($points / 1000000, 0).'M';
        } else {
            return number_format($points / 1000000000, 0).'B';
        }
    }

    public function render()
    {
        return view('livewire.courses.leaderboard');
    }
}
