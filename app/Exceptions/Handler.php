<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (\Exception $e, $request) {
        
            return $this->handleException($request, $e);
        });
    }

    public function handleException($request, \Exception $exception)
    {
        $message = $exception->getMessage();

        if ($exception instanceof AccessDeniedHttpException) {
            if (empty($message)) {
                $message = __('permission.denied');
            }
            return response(['success' => false, 'code' => 403, 'message' => $message], 403);
        }

        if ($exception instanceof NotFoundHttpException) {
            $message = __('data.not.found');

            return response(['success' => false, 'code' => 404, 'message' => $message], 404);
        }

        if ($exception instanceof AuthenticationException) {
            return response(['success' => false, 'code' => 401, 'message' => $message], 401);
        }

        if (empty($message)) {
            $message = __('server.error');
        }
       
       
        return response()->json(['success' => false, 'message' => $message], 500);
    }
}
