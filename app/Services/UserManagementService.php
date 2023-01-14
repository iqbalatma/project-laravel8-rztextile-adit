<?php
namespace App\Services;

use App\AppData;
use App\Jobs\SendVerificationEmailJob;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserManagementService
{

    /**
     * Description : use to get all data for index controller
     *
     * @return array
     */
    public function getAllData(): array
    {
        return [
            "title"       => "User Management",
            "description" => "Data user of this application",
            "cardTitle"   => "User Management",
            "users"       => (new UserRepository())->getAllDataUserPaginated()
        ];
    }


    /**
     * Description : use to get data for create new user form
     *
     * @return array
     */
    public function getCreateData(): array
    {
        return [
            "title"       => "User Management",
            "description" => "Form for add new data user",
            "cardTitle"   => "Add New User",
            "roles"       => (new RoleRepository())->getAllDataRole()->except([AppData::ROLE_ID_CUSTOMER, AppData::ROLE_ID_SUPERADMIN])
        ];
    }


    /**
     * Description : use to get data for create new user form
     *
     * @param int $id of user that want to be edited
     * @return array
     */
    public function getEditData(int $id): array
    {
        return [
            "title"       => "User Management",
            "description" => "Form for edit data user",
            "cardTitle"   => "Edit User",
            "roles"       => (new RoleRepository())->getAllDataRole(),
            "user"        => (new UserRepository())->getDataUserById($id)
        ];
    }


    /**
     * Description : use to add new data user
     *
     * @param array $requestedDatata
     * @return ?object of new eloquent instance
     */
    public function storeNewData(array $requestedData)
    {
        $requestedData["password"] = Hash::make($requestedData["password"]);
        $user = (new UserRepository())->addNewDataUser($requestedData);
        dispatch(new SendVerificationEmailJob($user));
        return $user;
    }


    /**
     * Description : use to update data user by user id
     *
     * @param int $id of user that want to be updated
     * @param array $requestedData request from client
     * @return bool status of update data success or fail
     */
    public function updateData(int $id, array $requestedData): bool
    {
        return (new UserRepository())->updateDataUserById($id, $requestedData);
    }

    /**
     * Delete data user by id
     * @param int $id
     * @return bool
     */
    public function suspendUserById(int $id): bool
    {
        return (new UserRepository())->suspendUserById($id);
    }
}

?>
