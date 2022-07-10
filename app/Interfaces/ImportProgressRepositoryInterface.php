<?php

namespace App\Interfaces;

interface ImportProgressRepositoryInterface
{
    public function get(string $file): int;
    public function set(string $file, int $progress): void;
    public function delete(string $file): void;
}
