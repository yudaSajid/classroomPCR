<?php

namespace Tests\Unit\Enums;

use App\Enums\ImageType;
use PHPUnit\Framework\TestCase;

class ImageTypeTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_values()
    {
        $this->assertEquals('thumbnail', ImageType::Thumbnail);
        $this->assertEquals('profile', ImageType::Profile);
        $this->assertEquals('GIF', ImageType::GIF);
    }

    /** @test */
    public function it_returns_the_correct_select_array()
    {
        $expected = [
            ImageType::Thumbnail => 'Thumbnail',
            ImageType::Profile => 'Profile',
            ImageType::GIF => 'GIF',
        ];

        $this->assertEquals($expected, ImageType::toSelectArray());
    }
}
