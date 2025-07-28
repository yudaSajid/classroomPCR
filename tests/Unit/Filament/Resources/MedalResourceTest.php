<?php

namespace Tests\Unit\Filament\Resources;

use App\Filament\Resources\MedalResource;
use App\Filament\Resources\MedalResource\Pages;
use App\Filament\Resources\MedalResource\RelationManagers\UsersRelationManager;
use App\Models\Medal;
use PHPUnit\Framework\TestCase;

class MedalResourceTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_model()
    {
        $this->assertEquals(Medal::class, MedalResource::getModel());
    }

    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-gift', MedalResource::getNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_active_navigation_icon()
    {
        $this->assertEquals('heroicon-s-gift', MedalResource::getActiveNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_navigation_group()
    {
        $this->assertEquals('Achievement', MedalResource::getNavigationGroup());
    }

    /** @test */
    public function it_returns_the_correct_relations()
    {
        $relations = MedalResource::getRelations();

        $this->assertCount(1, $relations);
        $this->assertEquals(UsersRelationManager::class, $relations[0]);
    }

    /** @test */
    public function it_returns_the_correct_pages()
    {
        $pages = MedalResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('edit', $pages);

        $this->assertEquals(Pages\ListMedals::route('/'), $pages['index']);
        $this->assertEquals(Pages\CreateMedal::route('/create'), $pages['create']);
        $this->assertEquals(Pages\EditMedal::route('/{record}/edit'), $pages['edit']);
    }
}
