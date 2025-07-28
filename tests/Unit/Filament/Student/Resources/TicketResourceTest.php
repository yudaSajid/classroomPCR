<?php

namespace Tests\Unit\Filament\Student\Resources;

use App\Filament\Student\Resources\TicketResource;
use App\Filament\Student\Resources\TicketResource\Pages;
use App\Filament\Student\Resources\TicketResource\RelationManagers\CommentsRelationManager;
use App\Models\Ticket;
use PHPUnit\Framework\TestCase;

class TicketResourceTest extends TestCase
{
    /** @test */
    public function it_has_the_correct_model()
    {
        $this->assertEquals(Ticket::class, TicketResource::getModel());
    }

    /** @test */
    public function it_has_the_correct_navigation_icon()
    {
        $this->assertEquals('heroicon-o-ticket', TicketResource::getNavigationIcon());
    }

    /** @test */
    public function it_returns_the_correct_relations()
    {
        $relations = TicketResource::getRelations();

        $this->assertCount(1, $relations);
        $this->assertEquals(CommentsRelationManager::class, $relations[0]);
    }

    /** @test */
    public function it_returns_the_correct_pages()
    {
        $pages = TicketResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('edit', $pages);

        $this->assertEquals(Pages\ListTickets::route('/'), $pages['index']);
        $this->assertEquals(Pages\CreateTicket::route('/create'), $pages['create']);
        $this->assertEquals(Pages\EditTicket::route('/{record}/edit'), $pages['edit']);
    }
}
