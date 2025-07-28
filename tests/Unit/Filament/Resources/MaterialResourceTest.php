<?php

namespace Tests\Unit\Filament\Resources;

use App\Filament\Resources\MaterialResource;
use App\Filament\Resources\MaterialResource\Pages;
use App\Filament\Resources\MaterialResource\RelationManagers\UserMaterialStatusRelationManager;
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
    public function it_has_the_correct_navigation_group()
    {
        $this->assertEquals('Course Management', MaterialResource::getNavigationGroup());
    }

    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-clipboard-document-list', MaterialResource::getNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_navigation_parent_item()
    {
        $this->assertEquals('Courses', MaterialResource::getNavigationParentItem());
    }

    /** @test */
    public function it_returns_the_correct_relations()
    {
        $relations = MaterialResource::getRelations();

        $this->assertCount(1, $relations);
        $this->assertEquals(UserMaterialStatusRelationManager::class, $relations[0]);
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
