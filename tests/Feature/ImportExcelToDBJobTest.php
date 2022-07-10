<?php

namespace Tests\Feature;

use App\Events\RowsNotification;
use App\Jobs\ImportExcelToDB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImportExcelToDBJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_import_job()
    {
        Storage::fake('local');
        Event::fake();

        $path = __DIR__ . '/../_files/test.xlsx';
        $file = new UploadedFile(
            $path,
            'test.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );
        $storedPath = $file->store('xlsx');

        ImportExcelToDB::dispatchSync($storedPath);

        $this->assertDatabaseCount('rows', 11);
        Event::assertDispatched(RowsNotification::class);

        $response = $this->get('/rows');
        $response->assertStatus(200);
        $response->assertSeeInOrder(['2020-10-27', '2020-10-31', '2020-11-06']);
    }
}
