<?php

namespace Tests\Unit\Filament\Student\Widgets;

use App\Filament\Student\Widgets\DashboardWidget;
use App\Models\User;
use App\Models\UserEducation;
use App\Models\UserInformation;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\TestCase;

class DashboardWidgetTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_column_span()
    {
        $widget = new DashboardWidget();
        $this->assertEquals('full', $widget->columnSpan);
    }

    /** @test */
    public function it_has_the_correct_view()
    {
        $this->assertEquals('filament.student.widgets.dashboard-widget', DashboardWidget::getView());
    }

    /** @test */
    public function mount_sets_has_user_info_and_has_user_edu_correctly()
    {
        // Mock Auth facade
        Auth::shouldReceive('id')->andReturn(1);
        Auth::shouldReceive('user')->andReturn(new User());

        // Mock UserInformation and UserEducation models
        UserInformation::shouldReceive('where')->andReturnSelf();
        UserInformation::shouldReceive('exists')->andReturn(true);

        UserEducation::shouldReceive('where')->andReturnSelf();
        UserEducation::shouldReceive('exists')->andReturn(false);

        $widget = new DashboardWidget();
        $widget->mount();

        $this->assertTrue($widget->hasUserInfo);
        $this->assertFalse($widget->hasUserEdu);
        $this->assertNotNull($widget->user);
    }
}
