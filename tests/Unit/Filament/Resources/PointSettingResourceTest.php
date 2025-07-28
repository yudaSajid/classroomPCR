<?php

namespace Tests\Unit\Filament\Resources;

use App\Filament\Resources\PointSettingResource;
use App\Filament\Resources\PointSettingResource\Pages;
use App\Models\PointSetting;
use PHPUnit\Framework\TestCase;

class PointSettingResourceTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_model()
    {
        $this->assertEquals(PointSetting::class, PointSettingResource::getModel());
    }

    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-cog-8-tooth', PointSettingResource::getNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_active_navigation_icon()
    {
        $this->assertEquals('heroicon-s-cog-8-tooth', PointSettingResource::getActiveNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_navigation_group()
    {
        $this->assertEquals('Achievement', PointSettingResource::getNavigationGroup());
    }

    /** @test */
    public function it_has_the_correct_navigation_parent_item()
    {
        $this->assertEquals('Points', PointSettingResource::getNavigationParentItem());
    }

    /** @test */
    public function it_returns_the_correct_relations()
    {
        $relations = PointSettingResource::getRelations();

        $this->assertCount(0, $relations);
    }

    /** @test */
    public function it_returns_the_correct_pages()
    {
        $pages = PointSettingResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('edit', $pages);

        $this->assertEquals(Pages\ListPointSettings::route('/'), $pages['index']);
        $this->assertEquals(Pages\CreatePointSetting::route('/create'), $pages['create']);
        $this->assertEquals(Pages\EditPointSetting::route('/{record}/edit'), $pages['edit']);
    }
}
