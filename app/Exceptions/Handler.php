<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

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

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, \Throwable $exception)
    {
        if ($request->expectsJson() && $exception instanceof ValidationException) {
            $errors = $exception->errors();
            $formattedErrors = [];

            foreach ($errors as $field => $messages) {
                foreach ($messages as $message) {
                    $formattedErrors[] = [
                        'field' => $field,
                        'issue' => $message,
                    ];
                }
            }

            return response()->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'success' => false,
                'errorCode' => 'VALIDATION_ERRORS',
                'message' => 'There were validation errors with the input data.',
                'errors' => $formattedErrors,
                'timestamp' => now()->toIso8601String(),
            ], Response::HTTP_BAD_REQUEST);
        }

        return parent::render($request, $exception);
    }
}
