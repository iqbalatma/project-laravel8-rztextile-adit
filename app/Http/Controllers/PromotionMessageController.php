<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromotionMessages\PromotionMessageStoreRequest;
use App\Services\PromotionMessageService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PromotionMessageController extends Controller
{

    /**
     * Description : use to get index view
     * 
     * @param PromotionMessageService $service dependency injection
     * @return Response
     */
    public function index(PromotionMessageService $service):Response
    {
        return response()->view("promotion-messages.index", $service->getAllData());
    }


    /**
     * Description : use to show create view
     * 
     * @param PromotionMessageService $service
     * @return Response
     */
    public function create(PromotionMessageService $service):Response
    {
        return response()->view("promotion-messages.create",$service->getCreateData());
    }


    /**
     * Description : use to add new data to database table
     * 
     * @param PromotionMessageService $service
     */
    public function store(PromotionMessageService $service, PromotionMessageStoreRequest $request)
    {
        $stored = $service->storeNewData($request->validated());

        $redirect = redirect()
            ->route("promotion.messages.index");

        $stored ?
            $redirect->with("success", "Add promotion message data roll successfully") :
            $redirect->with("failed", "Add promotion message data roll failed");

        return $redirect;
    }
}
