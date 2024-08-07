<?php

namespace App\Service;

use Exception;

class ResponseService
{
    public function handle(callable $callable)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => (new TransactionService())->handle($callable),
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], $exception->getCode());
        }
    }
}