<?php

namespace Tests\Unit\Filament\Resources;

use App\Filament\Resources\PeriodResource;
use App\Filament\Resources\PeriodResource\Pages;
use App\Filament\Resources\PeriodResource\RelationManagers\SemestersRelationManager;
use App\Models\Period;
use PHPUnit\Framework\TestCase;

class PeriodResourceTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_model()
    {
        $this->assertEquals(Period::class, PeriodResource::getModel());
    }

    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-calendar-days', PeriodResource::getNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_active_navigation_icon()
    {
        $this->assertEquals('heroicon-s-calendar-days', PeriodResource::getActiveNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_navigation_group()
    {
        $this->assertEquals('Education Management', PeriodResource::getNavigationGroup());
    }

    /** @test */
    public function it_returns_the_correct_relations()
    {
        $relations = PeriodResource::getRelations();

        $this->assertCount(1, $relations);
        $this->assertEquals(SemestersRelationManager::class, $relations[0]);
    }

    /** @test */
    public function it_returns_the_correct_pages()
    {
        $pages = PeriodResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('edit', $pages);

        $this->assertEquals(Pages\ListPeriods::route('/'), $pages['index']);
        $this->assertEquals(Pages\CreatePeriod::route('/create'), $pages['create']);
        $this->assertEquals(Pages\EditPeriod::route('/{record}/edit'), $pages['edit']);
    }
}
