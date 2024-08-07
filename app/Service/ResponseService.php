<?php

namespace App\Service;

use Exception;

class ResponseService
{
    public function handle(callable $function)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => TransactionService::handle($function),
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], $exception->getCode());
        }
    }
}