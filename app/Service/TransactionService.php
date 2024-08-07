<?php

namespace App\Service;

use Illuminate\Support\Facades\DB;

class TransactionService
{
    /**
     * @param callable $callable
     * @return mixed
     */
    public static function handle(callable $callable): mixed
    {
        return DB::transaction(function () use ($callable) {
            return $callable();
        });
    }
}