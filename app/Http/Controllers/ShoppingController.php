<?php

namespace App\Http\Controllers;

use App\Http\Requests\Shopping\PurchaseRequest;
use App\Services\ShoppingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ShoppingController extends Controller
{
    public function index(ShoppingService $service): Response
    {
        return response()->view("shopping.index", $service->getAllData());
    }

    public function purchase(ShoppingService $service, PurchaseRequest $request): JsonResponse
    {
        $stored = $service->purchase($request->validated());
        if ($stored) {
            return response()->json([
                "status"  => JsonResponse::HTTP_OK,
                "message" => "Purchasing successfully",
                "error"   => false,
                "data"    => $stored
            ]);
        } else {
            return response()->json([
                "status"  => JsonResponse::HTTP_NOT_ACCEPTABLE,
                "message" => "Something went wrong",
                "error"   => true,
            ]);
        }
    }
}
