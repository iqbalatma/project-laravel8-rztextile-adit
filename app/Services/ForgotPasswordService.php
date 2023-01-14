<?php

namespace App\Services;

use App\Jobs\SendForgotPasswordMailJob;
use App\Mail\ResetPasswordMail;
use App\Models\PasswordReset;
use App\Repositories\PasswordResetRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class ForgotPasswordService
{
    /**
     * Description : use to get all data for forgot view
     *
     * @return array
     */
    public function getForgotData(): array
    {
        return [
            "title" => "Forgot Password",
        ];
    }

    /**
     * Description : use to get all data for reset view
     *
     * @return array
     */
    public function getResetData(string $token, string $email): array
    {
        return [
            "title" => "Reset Password",
            "token" => $token,
            "email" => $email,
        ];
    }

    /**
     * Description : use to reset password
     *
     * @param array $requestedData email from reset password
     */
    public function sendResetRequest(array $requestedData)
    {
        $resetData = [
            "email"      => $requestedData["email"],
            "token"      => Str::random(40),
            "created_at" => Carbon::now(),
        ];

        $passwordRepository = new PasswordResetRepository();
        try {
            DB::beginTransaction();
            $user = (new UserRepository())->getDataUserByEmail($requestedData["email"]);
            if (!$user) {
                return false;
            }
            $passwordRepository->deleteDataPasswordResetByEmail($requestedData["email"]);

            $reset = $passwordRepository->addNewDataPasswordReset($resetData);

            dispatch(new SendForgotPasswordMailJob($reset));
            DB::commit();
        } catch (Exception $e) {
            dd($e);
            DB::rollback();
            return false;
        }
        return true;
    }

    public function resetPassword(array $requestedData)
    {
        try {
            DB::beginTransaction();
            $isTokenValid = (new PasswordResetRepository())->getDataPasswordResetByEmailToken(["email" => $requestedData["email"], "token" => $requestedData["token"]]);

            if (!$isTokenValid) {
                return false;
            }

            $updated = (new UserRepository())->updateDataUserByEmail($requestedData["email"], ["password" => Hash::make($requestedData["password"])]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }

        return $updated;
    }

}