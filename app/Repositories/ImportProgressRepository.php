<?php

namespace App\Repositories;

use App\Interfaces\ImportProgressRepositoryInterface;
use Illuminate\Support\Facades\Redis;

class ImportProgressRepository implements ImportProgressRepositoryInterface
{
    public function get(string $file): int
    {
        return Redis::get($this->redisKeyByFilename($file)) ?? 0;
    }

    public function set(string $file, int $progress): void
    {
        Redis::set($this->redisKeyByFilename($file), $progress);
    }

    public function delete(string $file): void
    {
        Redis::del($this->redisKeyByFilename($file));
    }

    private function redisKeyByFilename (string $filename): string
    {
        return "file-import:$filename";
    }
}
