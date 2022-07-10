<?php

namespace App\Repositories;

use App\Interfaces\RowsRepositoryInterface;
use App\Models\Row;

class RowsRepository implements RowsRepositoryInterface
{
    public function allGroupByDate(): array
    {
        $rowsByDate = Row::all()->groupBy('date')->toArray();

        return $rowsByDate;
    }

    public function save(array $rows): void
    {
        Row::upsert($rows, ['id'], ['name', 'date']);
    }
}
