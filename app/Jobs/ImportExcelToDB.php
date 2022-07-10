<?php

namespace App\Jobs;

use App\Events\RowsNotification;
use App\Imports\RowsImport;
use App\Repositories\ImportProgressRepository;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcelToDB implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public const ROWS_PER_JOB = 1000;

    public function __construct(
        public string $xlsxFile
    ) {}

    public function uniqueId()
    {
        return $this->xlsxFile;
    }

    public function handle(ImportProgressRepository $progressRepository)
    {
        $startRow = $progressRepository->get($this->xlsxFile);
        
        $import = new RowsImport($startRow, self::ROWS_PER_JOB);

        try {
            Excel::import($import, $this->xlsxFile);
        } catch (Exception $e) {
            Log::error('Unable to import file: '.$e->getMessage(), ['file' => $this->xlsxFile]);
            event(new RowsNotification("Error: unable to import file, see log for details."));
            return;
        }
        
        if ($import->lastRowProccessed()) {
            $progressRepository->delete($this->xlsxFile);
            Storage::delete($this->xlsxFile);
        } else {
            $progressRepository->set($this->xlsxFile, $startRow + self::ROWS_PER_JOB);
        }
    }
}
