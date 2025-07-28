<?php

namespace Tests\Unit\Filament\Student\Clusters;

use App\Filament\Clusters\Student\Profiles;
use Tests\TestCase; // Use Laravel's TestCase

class ProfilesTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-squares-2x2', Profiles::getNavigationIcon());
    }
}
