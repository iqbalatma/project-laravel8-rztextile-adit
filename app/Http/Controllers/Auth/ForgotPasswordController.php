<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\SendResetLinkRequest;
use App\Services\ForgotPasswordService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function forgot(ForgotPasswordService $service):Response
    {
        return response()->view("auth.forgot-password", $service->getForgotData());
    }

    public function reset(ForgotPasswordService $service, string $token, string $email)
    {
        return response()->view("auth.reset-password", $service->getResetData($token, $email));
    }

    public function sendResetLink(ForgotPasswordService $service, SendResetLinkRequest $request)
    {
        $status = $service->sendResetRequest($request->validated());

        if($status){
            return redirect()->route("forgot.password.forgot")->with("success", "Reset password link have been sent to your email !");
        }else{
            return redirect()->route("forgot.password.forgot")->with("failed", "Something went wrong ! Please try again later ");
        }
    }

    public function resetPassword(ForgotPasswordService $service, ResetPasswordRequest $request)
    {
        $updated = $service->resetPassword($request->validated());

        if($updated){
            return redirect()->route("auth.login")->with("success", "Reset password successfully, login to continue !");
        }else{
            return redirect()->route("auth.login")->with("failed", "Reset password failed, please try again later !");
        }
    }
}
