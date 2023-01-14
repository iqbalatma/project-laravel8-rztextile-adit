<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    /**
     * Show dashboard summary for transaction and finance
     * @param DashboardService $service
     * @return Response
     */
    public function index(DashboardService $service): Response
    {
        return response()->view("dashboard.index", $service->getAllData());
    }
}
