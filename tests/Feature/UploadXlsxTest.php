<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadXlsxTest extends TestCase
{
    public function test_upload_xlsx_file()
    {
        Storage::fake('local');

        $file = UploadedFile::fake()->create('rows.xlsx', 100, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        $response = $this->post('/', [
            'xlsx_file' => $file
        ]);

        $response->assertStatus(302);

        Storage::assertExists('xlsx/'.$file->hashName());
    }
}
