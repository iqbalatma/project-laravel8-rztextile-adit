<?php

namespace App\Http\Controllers;

use App\Http\Requests\RollTransactions\PutAwayRequest;
use App\Services\RollTransactionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class RollTransactionController extends Controller
{
    /**
     * Description : use to show all data roll transaction
     * 
     * @param RollTransactionService $service dependency injection
     * @return Response
     */
    public function index(RollTransactionService $service):Response
    {
        return response()->view("roll-transactions.index", $service->getAllData());
    }


    /**
     * Description : use to show form for put away roll
     * 
     * @param RollTransactionService $service dependency injection
     * @return Response
     */
    public function putAway(RollTransactionService $service):Response
    {
        return response()->view("roll-transactions.put-away", $service->getPutAwayData());
    }


    /**
     * Description : use to add new put away transaction
     * 
     * @param RollTransactionService $service dependency injection
     * @param PutAwayRequest $request dependency injection
     * @return RedirectResponse
     */
    public function putAwayTransaction(RollTransactionService $service, PutAwayRequest $request):RedirectResponse
    {
        $stored = $service->addNewPutAwayTransaction($request->validated());

        $redirect = redirect()
            ->route("roll.transactions.putAway");

        $stored ?
            $redirect->with("success", "Put away roll successfully") :
            $redirect->with("failed", "Put away roll failed");

        return $redirect;
    }
}
