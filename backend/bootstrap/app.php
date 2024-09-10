<?php

use App\Http\Middleware\AddHeadersToResponse;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\QueryException;



return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(prepend: [
            AddHeadersToResponse::class,
        ]);
//        $middleware->append(AddHeadersToResponse::class);
    })

->withExceptions(function (Exceptions $exceptions) {
    $exceptions->render(function (QueryException $e, Request $request) {
        if ($request->is('api/*')) {
            return response()->json([
                'errors' => [
                    'sql' =>$e->getMessage()
                ]
            ], 422);
        }
    });
})->create();
