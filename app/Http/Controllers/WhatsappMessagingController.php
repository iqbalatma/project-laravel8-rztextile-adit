<?php

namespace App\Http\Controllers;

use App\Http\Requests\WhatsappMessaging\WhatsappMessagingStoreRequest;
use App\Services\WhatsappMessagingService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Traits\WablasTrait;

class WhatsappMessagingController extends Controller
{
    public function index(WhatsappMessagingService $service): Response
    {
        return response()->view("whatsapp-messaging.index", $service->getAllData());
    }

    public function store(WhatsappMessagingService $service, WhatsappMessagingStoreRequest $request)
    {
        if (isset($request->validated()["type"]) && $request->validated()["type"] == "blast") {
            $sent = $service->sendBlast($request->validated());
        } else {
            $sent = $service->sendMessage($request->validated());
        }

        $redirect = redirect()
            ->route("whatsapp.messaging.index");

        $sent ?
            $redirect->with("success", "Send whatsapp message successfully") :
            $redirect->with("failed", "Send whatsapp message failed");

        return $redirect;
    }
}
