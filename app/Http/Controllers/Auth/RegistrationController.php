<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationStoreRequest;
use App\Services\RegistrationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class RegistrationController extends Controller
{
    /**
     * Description : use to show form registration
     *
     * @param RegistrationService $service dependency injection
     * @return Response
     */
    public function index(RegistrationService $service): Response
    {
        return response()->view("auth.registration", $service->getAllData());
    }

    /**
     * Description : use to add new data user
     *
     * @param RegistrationService $service dependency injection
     * @param RegistrationStoreRequest $request dependency injection
     * @return RedirectResponse
     */
    public function store(RegistrationService $service, RegistrationStoreRequest $request): RedirectResponse
    {
        $stored = $service->storeNewData($request->validated());
        $redirect = redirect()
            ->route("auth.login");

        $stored ?
            $redirect->with("success", "Register successfully") :
            $redirect->with("failed", "Register failed");

        return $redirect;
    }
}
