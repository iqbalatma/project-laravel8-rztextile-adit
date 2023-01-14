<?php

namespace App\Http\Controllers;

use App\Http\Requests\Rolls\RollPrintRequest;
use App\Http\Requests\Rolls\RollStoreRequest;
use App\Http\Requests\Rolls\RollUpdateRequest;
use App\Services\RollService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RollController extends Controller
{
    /**
     * Description : use to show all data rolls
     *
     * @param RollService $service dependency injection
     * @return Response
     */
    public function index(RollService $service): Response
    {
        return response()->view("rolls.index", $service->getAllData());
    }


    /**
     * Description : use to show form for add new roll
     *
     * @param RollService $service dependency injection
     * @return Response
     */
    public function create(RollService $service): Response
    {
        return response()->view("rolls.create", $service->getCreateData());
    }


    /**
     * Description : use to show form for edit roll
     *
     * @param RollService $service dependency injection
     * @return Response
     */
    public function edit(RollService $service, int $id): Response
    {
        return response()->view("rolls.edit", $service->getEditData($id));
    }


    /**
     * Description : use to update data roll
     *
     * @param RollService $service
     */
    public function update(RollService $service, RollUpdateRequest $request, int $id)
    {
        $updated = $service->updateData($id, $request->validated());
        $redirect = redirect()
            ->route("rolls.index");

        $updated ?
            $redirect->with("success", "Update data roll successfully") :
            $redirect->with("failed", "Update data roll failed");

        return $redirect;
    }


    /**
     * Description : use to add new roll data
     *
     * @param RollService $service dependency injection
     * @return RedirectResponse
     */
    public function store(RollService $service, RollStoreRequest $request): RedirectResponse
    {
        $stored = $service->storeNewData($request->validated());

        $redirect = redirect()
            ->route("rolls.index");

        $stored ?
            $redirect->with("success", "Add new data roll successfully") :
            $redirect->with("failed", "Add new data roll failed");

        return $redirect;
    }

    /**
     * Description : use to download qrcode file
     *
     * @param string $qrcode
     * @return
     */
    public function downloadQrcode(string $qrcode): StreamedResponse
    {
        $headers = ['Content-Type: image/jpeg'];
        return Storage::download("public/images/qrcode/$qrcode", "qrcode.png", $headers);
    }

    public function printQrcode(RollService $service, RollPrintRequest $request)
    {

        $data = [
            "copies" => $request->only("copies")["copies"]
        ];
        $pdf = Pdf::loadView("PDF/qrcode", $data);
        $customPaper = array(0, 0, 302, 302);
        $pdf->set_paper($customPaper);
        return $pdf->stream("itsolutionstuff.pdf");
    }
}
