<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UserStoreRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Services\UserManagementService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class UserManagementController extends Controller
{

    /**
     * Description : use to show user management index view
     *
     * @param UserManagementServcie $service dependency injection
     * @return Response
     */
    public function index(UserManagementService $service): Response
    {
        return response()->view("users.index", $service->getAllData());
    }


    /**
     * Description : use to show add new user form
     *
     * @param UserManagementService $service dependency injection
     * @return Response
     */
    public function create(UserManagementService $service): Response
    {
        return response()->view("users.create", $service->getCreateData());
    }


    /**
     * Description : use to add new data user
     *
     * @param UserManagementService $service dependency injection
     * @param StoreUserRequest $request dependency injection
     * @return RedirectResponse
     */
    public function store(UserManagementService $service, UserStoreRequest $request): RedirectResponse
    {
        $stored = $service->storeNewData($request->validated());

        $redirect = redirect()
            ->route("users.index");

        $stored ?
            $redirect->with("success", "Add new data user successfully") :
            $redirect->with("failed", "Add new data user failed");

        return $redirect;
    }


    /**
     * Description : use to show form for edit the data by id
     *
     * @param UserManagementService $service dependency injection
     * @param int $id of user
     * @return Response
     */
    public function edit(UserManagementService $service, int $id): Response
    {
        return response()->view("users.edit", $service->getEditData($id));
    }


    /**
     * Description : use to update data user by id
     *
     * @param UserManagementService $service dependency injection
     * @param UserUpdateRequest dependency injection
     * @param int $id of user that want to be edited
     * @return RedirectResponse
     */
    public function update(UserManagementService $service, UserUpdateRequest $request, int $id): RedirectResponse
    {
        $updated = $service->updateData($id, $request->validated());

        $redirect = redirect()
            ->route("users.index");

        $updated ?
            $redirect->with("success", "Update data user successfully") :
            $redirect->with("failed", "Update data user failed");

        return $redirect;
    }

    /**
     * Use to suspend an user
     * @param UserManagementService $service
     * @param int $id
     * @return RedirectResponse
     */
    public function suspend(UserManagementService $service, int $id): RedirectResponse
    {
        $deleted = $service->suspendUserById($id);

        $redirect = redirect()
            ->route("users.index");

        $deleted ?
            $redirect->with("success", "Suspend user successfully") :
            $redirect->with("failed", "Suspend user failed");

        return $redirect;
    }
}
