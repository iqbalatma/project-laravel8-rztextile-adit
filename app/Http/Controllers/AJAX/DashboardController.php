<?php

namespace App\Http\Controllers\AJAX;

use App\Http\Controllers\Controller;
use App\Services\AjaxDashboardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function salesSummary(AjaxDashboardService $service):JsonResponse
    {
        $data = $service->getSummarySalesData();
        return response()->json([
            "message" => "Get sales summary successfully",
            "status" => JsonResponse::HTTP_OK,
            "error" => false,
            "data" => $data
        ]);
    }
}
