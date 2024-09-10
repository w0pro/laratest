<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    public function sendError($errors = [], $code = 404): JsonResponse
    {
        return response()->json(['errors'=>$errors], $code);
    }
}
