<?php

namespace Tests\Feature;

use App\Jobs\ImportExcelToDB;
use App\Tasks\EnqueueXlsxImport;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EnqueueXlsxImportTest extends TestCase
{
    public function test_import_job_is_dispatched()
    {
        Queue::fake();
        Storage::fake('local');
        
        UploadedFile::fake()
            ->create('rows.xlsx', 100, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
            ->store('xlsx');

        (new EnqueueXlsxImport)();

        Queue::assertPushed(ImportExcelToDB::class, 1);
    }
}
