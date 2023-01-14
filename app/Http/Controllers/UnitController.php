<?php

namespace App\Http\Controllers;

use App\Http\Requests\Units\UnitStoreRequest;
use App\Http\Requests\Units\UnitUpdateRequest;
use App\Services\UnitService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class UnitController extends Controller
{
    /**
     * Description : use to show all data unit
     * 
     * @param UnitService $service dependency injection
     * @return Response for html view
     */
    public function index(UnitService $service):Response
    {
        return response()->view("units.index", $service->getAllData());
    }

    /**
     * Description : use to show form to add new unit
     * 
     * @param UnitService $service dependency injection
     * @return Response
     */
    public function create(UnitService $service):Response
    {
        return response()->view("units.create", $service->getCreateData());
    }


    /**
     * Description : use to add new unit
     * 
     * @param UnitService $service dependency injection
     * @param UnitStoreRequest $request dependency injection
     */
    public function store(UnitService $service, UnitStoreRequest $request)
    {
        $stored = $service->storeNewData($request->validated());

        $redirect = redirect()
            ->route("units.index");
            
        $stored?
            $redirect->with("success", "Add new data unit successfully"):
            $redirect->with("failed", "Add new data unit failed");

        return $redirect;
    }

    /**
     * Description : use to show edit form for unit by id
     * 
     * @param UnitService $service dependency injection
     * @param int $id of unit that want to edit
     */
    public function edit(UnitService $service, int $id):Response
    {
        return response()->view("units.edit", $service->getEditData($id));
    }


    /**
     * Description : use to update data unit with requested data
     * 
     * @param UnitService $service dependency injection
     * @param UnitUpdateRequest $request dependency injection
     * @param int $id of unit that want to update
     */
    public function update(UnitService $service, UnitUpdateRequest $request, int $id):RedirectResponse
    {
        $updated = $service->updateData($id, $request->validated());
        $redirect = redirect()
            ->route("units.index");
            
        $updated?
            $redirect->with("success", "Update data unit successfully"):
            $redirect->with("failed", "Update data unit failed");

        return $redirect;
    }


    /**
     * Description : use to delete data unit by id
     * 
     * @param UnitService $service dependency injection
     * @param int $id of unit that want to delete
     * @return RedirectResponse
     */
    public function destroy(UnitService $service, int $id):RedirectResponse
    {
        $deleted = $service->deleteData($id);

        $redirect = redirect()
            ->route("units.index");
            
        $deleted?
            $redirect->with("success", "Delete data unit successfully"):
            $redirect->with("failed", "Delete data unit failed");

        return $redirect;
    }
}
