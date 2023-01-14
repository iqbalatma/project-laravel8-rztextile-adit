<?php

namespace App\Repositories;

use App\Models\PasswordReset;
use Illuminate\Support\Facades\DB;

class PasswordResetRepository
{
    public function addNewDataPasswordReset(array $requestedData)
    {
        DB::table("password_resets")->insert($requestedData);
        return DB::table("password_resets")->where("email", $requestedData["email"])->first();
    }

    public function deleteDataPasswordResetByEmail(string $email)
    {
        return DB::table('password_resets')->where("email", $email)->delete();
    }

    public function getDataPasswordResetByEmailToken(array $whereClause)
    {
        return PasswordReset::where($whereClause)->first();
    }
}
