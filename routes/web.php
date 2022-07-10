<?php

use App\Events\RowsNotification;
use App\Http\Controllers\RowsIndex;
use App\Http\Controllers\UploadXlsxController;
use App\Imports\RowsImport;
use App\Interfaces\ImportProgressRepositoryInterface;
use App\Jobs\TestJob;
use App\Models\Row;
use App\Tasks\EnqueueXlsxImport;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UploadXlsxController::class, 'index']);
Route::post('/', [UploadXlsxController::class, 'handle']);

Route::get('/rows', RowsIndex::class);
