<?php

namespace App\Http\Controllers\AJAX;

use App\Http\Controllers\Controller;
use App\Services\AjaxSearchRollService;
use Illuminate\Http\JsonResponse;

class SearchRollController extends Controller
{
    public function show(AjaxSearchRollService $service, int $id):JsonResponse
    {
        $data = $service->getShowData($id);
        return response()->json([
            "message" => "Get roll by id successfully",
            "status" => JsonResponse::HTTP_OK,
            "error" => false,
            "data" => $data
        ]);
    }
}
