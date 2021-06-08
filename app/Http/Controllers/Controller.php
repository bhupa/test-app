<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function success($result, $message = '')
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $result
        ];

        return response()->json($response,200);
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
    public function validationErrors($data)
    {
        $response = [
            'success' => false,
            'message'=>'Input Field Required',
            'errors' => $data
        ];
        return response()->json($response, 422);
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
