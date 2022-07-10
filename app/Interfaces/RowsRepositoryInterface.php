<?php

namespace App\Interfaces;

interface RowsRepositoryInterface
{
    public function allGroupByDate(): array;
    public function save(array $rows): void;
}
