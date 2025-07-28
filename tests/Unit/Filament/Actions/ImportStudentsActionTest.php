<?php

namespace Tests\Unit\Filament\Actions;

use App\Filament\Actions\ImportStudentsAction;
use PHPUnit\Framework\TestCase;

class ImportStudentsActionTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_name()
    {
        $this->assertEquals('importStudents', ImportStudentsAction::getDefaultName());
    }
}
