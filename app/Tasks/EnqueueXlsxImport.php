<?php

namespace App\Tasks;

use App\Jobs\ImportExcelToDB;
use Illuminate\Support\Facades\Storage;

class EnqueueXlsxImport
{
    public function __invoke()
    {
        $files = Storage::disk('local')->files('xlsx');

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'xlsx') {
                ImportExcelToDB::dispatch($file);
            }
        }
    }
    
}
