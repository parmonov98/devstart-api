<?php

namespace App\Exceptions;

use App\ViewModels\Api\JsonApiViewModel;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * @param $request
     * @param Throwable $e
     *
     * @return JsonApiViewModel|JsonResponse|Response|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render(
        $request,
        Throwable $e
    ): Response|JsonResponse|\Symfony\Component\HttpFoundation\Response|JsonApiViewModel {
        if ($e instanceof ValidationException) {
            return JsonApiViewModel::getErrorResponse($e->validator->errors()->first(), -422);
        }

        if ($e instanceof AuthenticationException) {
            return JsonApiViewModel::getErrorResponse(__('auth.unauthenticated'), -401);
        }

        if ($e instanceof AuthorizationException) {
            return JsonApiViewModel::getErrorResponse(__('messages.not_access'), -403);
        }

        if ($e instanceof NotFoundHttpException) {
            return JsonApiViewModel::getErrorResponse(__('messages.page_not_found'), -404);
        }

        if ($e instanceof ModelNotFoundException) {
            return JsonApiViewModel::getErrorResponse(__('messages.not_found'), -404);
        }

        if ($e instanceof ClientException) {
            return JsonApiViewModel::getErrorResponse(__('messages.invalid_credentials_provider'), -422);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return JsonApiViewModel::getErrorResponse($e->getMessage(), $e->getCode());
        }

        if ($e instanceof BusinessLogicException) {
            return JsonApiViewModel::getErrorResponse($e->getMessage(), $e->getCode());
        }

        return parent::render($request, $e);
    }
}
