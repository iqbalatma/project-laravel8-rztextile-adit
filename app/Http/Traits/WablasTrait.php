<?php

namespace App\Http\Traits;

use GuzzleHttp\Client;

trait WablasTrait
{
    public static function sendMessage($payload)
    {
        $token = config("wablas.token");
        $baseUrl = config("wablas.base_url");
        $client = new Client([
            "base_uri" => $baseUrl,
            "timeout" => 5,
            "headers" => [
                "Authorization" => $token,
                "Content-Type" => "application/json"
            ],
        ]);

        $response = $client->post("/api/v2/send-message",  ["body" => json_encode($payload)]);
        $response = json_decode($response->getBody(), true);
        return $response["status"];
    }
}
