<?php

namespace Tests\Unit\Filament\Teacher\Resources;

use App\Filament\Teacher\Resources\MaterialResource;
use App\Filament\Teacher\Resources\MaterialResource\Pages;
use App\Models\Material;
use PHPUnit\Framework\TestCase;

class MaterialResourceTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_model()
    {
        $this->assertEquals(Material::class, MaterialResource::getModel());
    }

    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-rectangle-stack', MaterialResource::getNavigationIcon());
    }

    /** @test */
    public function it_should_not_register_navigation()
    {
        $this->assertFalse(MaterialResource::shouldRegisterNavigation());
    }

    /** @test */
    public function it_returns_the_correct_relations()
    {
        $relations = MaterialResource::getRelations();

        $this->assertCount(0, $relations);
    }

    /** @test */
    public function it_returns_the_correct_pages()
    {
        $pages = MaterialResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('edit', $pages);

        $this->assertEquals(Pages\ListMaterials::route('/'), $pages['index']);
        $this->assertEquals(Pages\CreateMaterial::route('/create'), $pages['create']);
        $this->assertEquals(Pages\EditMaterial::route('/{record}/edit'), $pages['edit']);
    }
}
