<?php

namespace Tests\Unit\Enums;

use App\Enums\Status;
use PHPUnit\Framework\TestCase;

class StatusTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_values()
    {
        $this->assertEquals('pending', Status::Pending);
        $this->assertEquals('approved', Status::Approved);
        $this->assertEquals('reject', Status::Reject);
    }

    /** @test */
    public function it_returns_the_correct_select_array()
    {
        $expected = [
            Status::Pending => 'Pending',
            Status::Approved => 'Approved',
            Status::Reject => 'Reject',
        ];

        $this->assertEquals($expected, Status::toSelectArray());
    }
}
