<?php

namespace App\Http\Controllers;

use App\Http\Requests\Payments\PaymentStoreRequest;
use App\Services\PaymentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class PaymentController extends Controller
{
    /**
     * Description : use to show list of payments
     * 
     * @param PaymentService $service for execute business logic
     * @return Response 
     */
    public function index(PaymentService $service):Response
    {
        return response()->view("payments.index", $service->getAllData());
    }


    /**
     * Description : use to show create form for payment
     * 
     * @param 
     */
    public function create(PaymentService $service)
    {
        return response()->view("payments.create", $service->getCreateData());
    }


    public function createByInvoiceId(PaymentService $service, int $invoiceId):Response
    {
        return response()->view("payments.create-by-invoice-id", $service->getDataCreateByInvoiceId($invoiceId));
    }


    /**
     * Description : use to add new payment
     * 
     * @param PaymentService $service
     * @param PaymentStoreRequest to validation
     * @return RedirectResponse
     */
    public function store(PaymentService $service, PaymentStoreRequest $request):RedirectResponse
    {
        $change = $service->storeNewData($request->validated());

        return redirect()
            ->route("payments.index")
            ->with("success", "Add new payment successfully ! Change " . formatToRupiah($change));
    }
}
