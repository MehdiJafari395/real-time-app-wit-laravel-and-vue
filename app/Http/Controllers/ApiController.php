<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function successResponse($data = [], $message = '', $statusCode = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    public function errorResponse($message = '', $statusCode = 200)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => [],
        ], $statusCode);
    }
}
