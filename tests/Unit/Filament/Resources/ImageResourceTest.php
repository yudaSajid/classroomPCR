<?php

namespace Tests\Unit\Filament\Resources;

use App\Filament\Resources\ImageResource;
use App\Filament\Resources\ImageResource\Pages;
use App\Models\Image;
use PHPUnit\Framework\TestCase;

class ImageResourceTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_model()
    {
        $this->assertEquals(Image::class, ImageResource::getModel());
    }

    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-photo', ImageResource::getNavigationIcon());
    }

    /** @test */
    public function it_returns_the_correct_relations()
    {
        $relations = ImageResource::getRelations();

        $this->assertCount(0, $relations);
    }

    /** @test */
    public function it_returns_the_correct_pages()
    {
        $pages = ImageResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayNotHasKey('create', $pages);
        $this->assertArrayNotHasKey('edit', $pages);

        $this->assertEquals(Pages\ListImages::route('/'), $pages['index']);
    }
}
