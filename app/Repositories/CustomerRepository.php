<?php

namespace App\Repositories;

use App\AppData;
use App\Models\User;

class CustomerRepository
{

    public function getAllDataCustomerPaginated(string|bool $search = false, array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE): ?object
    {
        $users = User::with("role")
            ->select($columns)
            ->where("role_id", AppData::ROLE_ID_CUSTOMER);

        if ($search) {
            $users->where("id_number", "LIKE", "%$search%")
                ->orWhere("name", "LIKE", "%$search%")
                ->orWhere("email", "LIKE", "%$search%")
                ->orWhere("address", "LIKE", "%$search%")
                ->orWhere("phone", "LIKE", "%$search%");
        }

        $users = $users->paginate($perPage)->appends(request()->query());

        return $users;
    }

    public function getAllDataCustomer(array $columns = ["*"])
    {
        return User::with("role")
            ->select($columns)
            ->where("role_id", AppData::ROLE_ID_CUSTOMER)
            ->get();
    }


    public function addNewDataCustomer(array $requestedData): ?object
    {
        return User::create($requestedData);
    }

    public function getCustomerById(int $id, array $columns = ["*"])
    {
        return User::find($id, $columns);
    }

    public function getCustomerByIds(array $ids, array $columns = ["*"])
    {
        return User::select($columns)->find($ids);
    }

    public function updateCustomerById(int $id, array $requestedData): bool
    {
        return User::where("id", $id)->update($requestedData);
    }

    public function deleteCustomerById(int $id): bool
    {
        return User::destroy($id);
    }

    public function getDataCustomerForRFM()
    {
        return User::select("id", "name")
            ->withCount("invoiceCustomer")
            ->withMax("invoiceCustomer", "total_bill")
            ->withMax("invoiceCustomer", "created_at")
            ->where("role_id", 5)
            ->get();
    }
}
