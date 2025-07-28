<?php

namespace Tests\Unit\Filament\Resources\ProgramsResource\RelationManagers;

use App\Filament\Resources\ProgramsResource\RelationManagers\ProgramNameRelationManager;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class ProgramNameRelationManagerTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_relationship()
    {
        $reflection = new ReflectionClass(ProgramNameRelationManager::class);
        $property = $reflection->getProperty('relationship');
        $property->setAccessible(true);

        $this->assertEquals('programs', $property->getValue(null));
    }
}