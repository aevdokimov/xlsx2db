<?php

namespace App\Http\Controllers;

use App\Interfaces\RowsRepositoryInterface;
use Illuminate\Http\Request;

class RowsIndex extends Controller
{
    public function __invoke(Request $request, RowsRepositoryInterface $rowsRepository)
    {
        $rowsByDate = $rowsRepository->allGroupByDate();

        return view('rows_index', compact('rowsByDate'));
    }
}
