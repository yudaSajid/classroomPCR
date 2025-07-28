<?php

namespace Tests\Unit\Filament\Imports;

use App\Filament\Imports\StudentImporter;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Models\Import;
use PHPUnit\Framework\TestCase;

class StudentImporterTest extends TestCase
{
    /** @test */
    public function it_returns_the_correct_columns()
    {
        $columns = StudentImporter::getColumns();

        $this->assertCount(2, $columns);
        $this->assertInstanceOf(ImportColumn::class, $columns[0]);
        $this->assertEquals('name', $columns[0]->getName());
        $this->assertInstanceOf(ImportColumn::class, $columns[1]);
        $this->assertEquals('email', $columns[1]->getName());
    }

    /** @test */
    public function it_returns_the_correct_completed_notification_body_with_no_failed_rows()
    {
        $import = new class extends Import {
            public int $successful_rows;
            public function getFailedRowsCount(): int { return 0; }
        };
        $import->successful_rows = 10;

        $body = StudentImporter::getCompletedNotificationBody($import);

        $this->assertEquals('Import completed: 10 students imported.', $body);
    }

    /** @test */
    public function it_returns_the_correct_completed_notification_body_with_failed_rows()
    {
        $import = new class extends Import {
            public int $successful_rows;
            public function getFailedRowsCount(): int { return 2; }
        };
        $import->successful_rows = 8;

        $body = StudentImporter::getCompletedNotificationBody($import);

        $this->assertEquals('Import completed: 8 students imported. 2 failed.', $body);
    }
}