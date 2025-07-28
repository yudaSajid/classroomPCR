<?php

namespace Tests\Unit\Filament\Resources;

use App\Filament\Resources\PointResource;
use App\Filament\Resources\PointResource\Pages;
use App\Models\Point;
use PHPUnit\Framework\TestCase;

class PointResourceTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_model()
    {
        $this->assertEquals(Point::class, PointResource::getModel());
    }

    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-star', PointResource::getNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_navigation_group()
    {
        $this->assertEquals('Achievement', PointResource::getNavigationGroup());
    }

    /** @test */
    public function it_returns_the_correct_relations()
    {
        $relations = PointResource::getRelations();

        $this->assertCount(0, $relations);
    }

    /** @test */
    public function it_returns_the_correct_pages()
    {
        $pages = PointResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('edit', $pages);

        $this->assertEquals(Pages\ListPoints::route('/'), $pages['index']);
        $this->assertEquals(Pages\CreatePoint::route('/create'), $pages['create']);
        $this->assertEquals(Pages\EditPoint::route('/{record}/edit'), $pages['edit']);
    }
}
