<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
{
    if ($exception instanceof ModelNotFoundException || $exception instanceof NotFoundHttpException) {
        return response()->json([
            'status' => false,
            'data' => null,
            'message' => 'Data tidak ditemukan',
        ], Response::HTTP_NOT_FOUND);
    }
    if ($exception instanceof MethodNotAllowedHttpException) {
        return response()->json([
            'status' => false,
            'data' => null,
            'message' => 'Metode tidak diizinkan',
        ], Response::HTTP_METHOD_NOT_ALLOWED);
    }

    return parent::render($request, $exception);
}
}
