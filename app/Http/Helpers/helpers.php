<?php

use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;

// FUNCTIONS
if (!function_exists('responseJson')) {
    function responseJson(bool $success, string $message = '', int $code = 200, $data = []): JsonResponse {
        return response()->json([
            'success' => $success,
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}

if (!function_exists('textTransform')) {
    function textTransform($text, $transform = 'lower') {
        $transform = Str::of(trim($transform))->lower();
        switch ($transform) {
            case 'lower':
                return Str::of($text)->lower();

            case 'upper':
                return Str::of($text)->upper();

            case 'title':
                return Str::of($text)->title();

            case 'ucfirst':
                return Str::of($text)->ucfirst();

            default:
                return Str::of($text)->lower();
        }
    }
}
// END FUNCTIONS