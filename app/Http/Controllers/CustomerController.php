<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customers\CustomerStoreRequest;
use App\Http\Requests\Customers\CustomerUpdateRequest;
use App\Services\CustomerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class CustomerController extends Controller
{

    /**
     * Description : use to show all data customer
     *
     * @param CustomerService $service dependency injection
     * @return Response
     */
    public function index(CustomerService $service): Response
    {
        return response()->view("customers.index", $service->getAllData());
    }

    /**
     * Description : use to show add new customer form
     *
     * @param CustomerService $service dependency injection
     * @return Response
     */
    public function create(CustomerService $service): Response
    {
        return response()->view("customers.create", $service->getCreateData());
    }

    /**
     * Description : use to update data customer
     *
     * @param CustomerService $service dependency injection
     * @param CustomerStoreRequest $request dependency injection
     * @return RedirectResponse
     */
    public function store(CustomerService $service, CustomerStoreRequest $request): RedirectResponse
    {
        $stored = $service->storeNewData($request->validated());

        $redirect = redirect()
            ->route("customers.index");

        $stored ?
            $redirect->with("success", "Add new data customer successfully") :
            $redirect->with("failed", "Add new data customer failed");

        return $redirect;
    }

    /**
     * Description : use to show form for edit data customer
     *
     * @param CustomerService $service dependency injection
     * @param int $id of customer that want to edit
     * @return Response
     */
    public function edit(CustomerService $service, int $id): Response
    {
        return response()->view("customers.edit", $service->getEditData($id));
    }

    /**
     * Description : use to update data into new data
     *
     * @param CustomerService $service dependency injection
     * @param CustomerUpdateRequest $request dependency injection
     * @param int $id of customer that want to update
     * @return RedirectResponse
     */
    public function update(CustomerService $service, CustomerUpdateRequest $request, int $id): RedirectResponse
    {
        $updated = $service->updateData($id, $request->validated());

        $redirect = redirect()
            ->route("customers.index");

        $updated ?
            $redirect->with("success", "Update data customer successfully") :
            $redirect->with("failed", "Update data customer failed");

        return $redirect;
    }

    /**
     * Description : use to delete data unit by id
     *
     * @param CustomerService $service dependency injection
     * @param int $id of unit that want to delete
     * @return RedirectResponse
     */
    public function destroy(CustomerService $service, int $id): RedirectResponse
    {
        $deleted = $service->deleteData($id);

        $redirect = redirect()
            ->route("customers.index");

        $deleted ?
            $redirect->with("success", "Delete data customer successfully") :
            $redirect->with("failed", "Delete data customer failed");

        return $redirect;
    }
}
