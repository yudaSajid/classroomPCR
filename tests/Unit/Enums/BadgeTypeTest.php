<?php

namespace Tests\Unit\Enums;

use App\Enums\BadgeType;
use PHPUnit\Framework\TestCase;

class BadgeTypeTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_values()
    {
        $this->assertEquals('default', BadgeType::Default->value);
        $this->assertEquals('custom', BadgeType::Custom->value);
    }

    /** @test */
    public function it_returns_the_correct_label()
    {
        $this->assertEquals('Default', BadgeType::Default->getLabel());
        $this->assertEquals('Custom', BadgeType::Custom->getLabel());
    }

    /** @test */
    public function it_returns_the_correct_color()
    {
        $this->assertEquals('info', BadgeType::Default->getColor());
        $this->assertEquals('success', BadgeType::Custom->getColor());
    }

    /** @test */
    public function it_returns_the_correct_icon()
    {
        $this->assertEquals('heroicon-m-document', BadgeType::Default->getIcon());
        $this->assertEquals('heroicon-m-cog', BadgeType::Custom->getIcon());
    }
}
