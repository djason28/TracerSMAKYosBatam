<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\Access\AuthorizationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Report or log an exception.
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        // Only respond with JSON for API (expectsJson) requests
        if ($request->expectsJson()) {

            if ($exception instanceof ValidationException) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Validasi gagal',
                    'errors'  => $exception->errors(),
                ], 422);
            }

            if ($exception instanceof AuthenticationException) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Unauthorized, login terlebih dahulu.',
                ], 401);
            }

            if ($exception instanceof AuthorizationException) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Anda tidak memiliki izin untuk melakukan ini.',
                ], 403);
            }

            if ($exception instanceof ModelNotFoundException) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Data tidak ditemukan.',
                ], 404);
            }

            // Fallback for any other exceptions
            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi kesalahan internal.',
                'error'   => config('app.debug') ? $exception->getMessage() : null,
            ], 500);
        }

        return parent::render($request, $exception);
    }
}
