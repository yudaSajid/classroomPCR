<?php

namespace Tests\Unit\Filament\Resources;

use App\Filament\Resources\ChallengeResource;
use App\Filament\Resources\ChallengeResource\Pages;
use App\Filament\Resources\ChallengeResource\RelationManagers\TasksRelationManager;
use App\Models\Challenge;
use PHPUnit\Framework\TestCase;

class ChallengeResourceTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_model()
    {
        $this->assertEquals(Challenge::class, ChallengeResource::getModel());
    }

    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-code-bracket-square', ChallengeResource::getNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_active_navigation_icon()
    {
        $this->assertEquals('heroicon-s-code-bracket-square', ChallengeResource::getActiveNavigationIcon());
    }

    /** @test */
    public function it_has_the_correct_navigation_group()
    {
        $this->assertEquals('Course Management', ChallengeResource::getNavigationGroup());
    }

    /** @test */
    public function it_has_the_correct_record_title_attribute()
    {
        $this->assertEquals('challenge_name', ChallengeResource::getRecordTitleAttribute());
    }

    /** @test */
    public function it_returns_the_correct_global_search_result_title()
    {
        $challenge = new Challenge();
        $challenge->challenge_name = 'Test Challenge';

        $this->assertEquals('Test Challenge', ChallengeResource::getGlobalSearchResultTitle($challenge));
    }

    /** @test */
    public function it_returns_the_correct_global_search_result_details()
    {
        $challenge = new Challenge();
        $challenge->challenge_name = 'Test Challenge';

        $this->assertEquals([
            'Challenge' => 'Test Challenge',
        ], ChallengeResource::getGlobalSearchResultDetails($challenge));
    }

    /** @test */
    public function it_returns_the_correct_relations()
    {
        $relations = ChallengeResource::getRelations();

        $this->assertCount(1, $relations);
        $this->assertEquals(TasksRelationManager::class, $relations[0]);
    }

    /** @test */
    public function it_returns_the_correct_pages()
    {
        $pages = ChallengeResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('edit', $pages);

        $this->assertEquals(Pages\ListChallenges::route('/'), $pages['index']);
        $this->assertEquals(Pages\CreateChallenge::route('/create'), $pages['create']);
        $this->assertEquals(Pages\EditChallenge::route('/{record}/edit'), $pages['edit']);
    }
}
