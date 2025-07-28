<?php

namespace Tests\Unit\Enums;

use App\Enums\Material;
use PHPUnit\Framework\TestCase;

class MaterialTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_values()
    {
        $this->assertEquals('quiz', Material::Quiz);
        $this->assertEquals('duration', Material::Duration);
        $this->assertEquals('skip', Material::Skip);
    }

    /** @test */
    public function it_returns_the_correct_action_array()
    {
        $expected = [
            Material::Quiz => 'Quiz',
            Material::Duration => 'Duration',
            Material::Skip => 'Skip',
        ];

        $this->assertEquals($expected, Material::toActionArray());
    }
}
