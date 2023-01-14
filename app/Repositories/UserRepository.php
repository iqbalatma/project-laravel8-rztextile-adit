<?php
namespace App\Repositories;

use App\AppData;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    private User $model;
    public function __construct()
    {
        $this->model = new User();
    }

    public function getAllDataUserPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE): ?object
    {
        return User::with("role")
            ->select($columns)
            ->where("role_id", "!=", AppData::ROLE_ID_CUSTOMER)
            ->where("id", "!=", Auth::user()->id)
            ->paginate($perPage);
    }

    public function addNewDataUser(array $requestedData): ?object
    {
        return User::create($requestedData);
    }

    public function getDataUserById(int $id, array $columns = ["*"]): ?object
    {
        return User::select($columns)->find($id);
    }

    public function getDataUserByEmail(string $email, array $columns = ["*"])
    {
        return User::where("email", $email)->first($columns);
    }

    public function updateDataUserById(int $id, array $requestedData)
    {
        return User::where("id", $id)->update($requestedData);
    }

    public function updateDataUserByEmail(string $email, array $requestedData)
    {
        return User::where("email", $email)->update($requestedData);
    }

    public function deleteDataUserById(int $id)
    {
        return $this->model->destroy($id);
    }

    public function suspendUserById(int $id)
    {
        return $this->model->where("id", $id)->update(["is_active" => false]);
    }
}

?>
