<?php

namespace Tests\Unit\Filament\Student\Pages;

use App\Filament\Student\Pages\UserInfo;
use PHPUnit\Framework\TestCase;

class UserInfoTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-document-text', UserInfo::getNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_view()
    {
        $this->assertEquals('filament.student.pages.user-info', (new UserInfo())->getView());
    }

    /** @test */
    public function it_has_the_correct_navigation_group()
    {
        $this->assertEquals('User Management', UserInfo::getNavigationGroup());
    }

    /** @test */
    public function it_has_the_correct_navigation_label()
    {
        $this->assertEquals('Informations', UserInfo::getNavigationLabel());
    }
}