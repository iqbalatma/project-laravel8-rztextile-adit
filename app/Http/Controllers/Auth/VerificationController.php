<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    protected $redirectTo = "/";
    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                        ? redirect("/")
                        : view('auth.verification', [
                            'title' => __('Account Verification'),
                            'cardTitle' => __('Account Verification'),
                            'pageTitle' => __('Account Verification')
                        ]);
    }


    /**
     * Description : use to resend email verification
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function resend(Request $request):RedirectResponse
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Verification link sent!');
    }


    /**
     * Description : use to verify link verification
     * 
     * @param EmailVerificationRequest $request
     * @return RedirectResponse
     */
    public function verify(EmailVerificationRequest $request):RedirectResponse
    {
        $request->fulfill();
        return response()->redirectTo(route("dashboard.index"));
    }
}
