<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticateRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    /**
     * Description : use to show form login
     * 
     * @param AuthService $service dependency injection
     * @return Response
     */
    public function login(AuthService $service):Response
    {
        return response()->view("auth.login", $service->getLoginData());
    }


    /**
     * Description : use to check is user authenticate or not
     * 
     * @param AuthService $service dependency injection
     * @param AuthenticateRequest $request dependency injection
     * @return RedirectResponse
     */
    public function authenticate(AuthService $service, AuthenticateRequest $request):RedirectResponse
    {
        if($service->authenticate($request->validated())){
            return redirect()->intended(route("dashboard.index"));
        }

        return redirect()->back()->with("failed", "Username or password is invalid");
    }


    /**
     * Description : use to logout account
     * 
     * @param AuthService $service dependency injection
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(AuthService $service, Request $request):RedirectResponse
    {
        $service->logout($request);
        return redirect('/');
    }


}
