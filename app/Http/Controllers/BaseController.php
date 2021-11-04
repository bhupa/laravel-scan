<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BaseController extends Controller
{
    public function success($result, $message = '')
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $result
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function error($error, $data = [], $code = 404)
    {
        $response = [
            'success' => false,
            'errors' => $error
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }
        return response()->json($response, $code);
    }

    /* * Success response method with pagination */
    public function withPagination($result, $message = '')
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $result->items(),
            'pagination' => $this->paginationToArray($result)
        ];

        return response()->json($response, 200);
    }

    public function paginationToArray($resource)
    {
        return [
            'total' => $resource->total(),
            'count' => $resource->count(),
            'per_page' => $resource->perPage(),
            'current_page' => $resource->currentPage(),
            'last_page' => $resource->lastPage(),
            'from' => $resource->firstItem(),
            'to' => $resource->lastItem(),
            'first_page_url' => $resource->url(1),
            'next_page_url' => $resource->nextPageUrl(),
            'prev_page_url' => $resource->previousPageUrl(),
            'last_page_url' => $resource->url($resource->lastPage()),];
    }

    public function accessDenied($message='permission denied')
    {
        $response = [
            'success' => false,
            'message' => $message
        ];

        return response()->json($response, Response::HTTP_FORBIDDEN);
    }
}
