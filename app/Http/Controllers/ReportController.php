<?php

namespace App\Http\Controllers;

use App\Http\Requests\Reports\ReportDownloadRequest;
use App\Services\ReportService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class ReportController extends Controller
{
    /**
     * Description : use to show view report
     * 
     */
    public function index(ReportService $service):Response
    {
        return response()->view("reports.index", $service->getAllData());
    }


    /**
     * Description : use to download report
     * 
     * @param ReportService
     * @
     */
    public function download(ReportService $service, ReportDownloadRequest $request)
    {
        $data = $service->downloadReport($request->validated());
        $pdf = Pdf::loadView("PDF.report", $data);
        return $pdf->download();
    }
}
