<?php
namespace App\Repositories;

use App\AppData;
use App\Models\Unit;

class UnitRepository
{

    private Unit $modal;

    public function __construct()
    {
        $this->modal = new Unit();
    }
    public function getAllDataUnitPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE): ?object
    {
        return $this->modal
            ->select($columns)
            ->paginate($perPage);
    }

    public function getAllDataUnit(array $columns = ["*"])
    {
        return $this->modal->select($columns)->get();
    }

    public function getDataUnitById(int $id, $columns = ["*"]): ?object
    {
        return $this->modal->find($id, $columns);
    }

    public function updateDataUnitById(int $id, array $requestedData): bool
    {
        return $this->modal->where("id", $id)->update($requestedData);
    }

    public function addNewDataUnit(array $requestedData): ?object
    {
        return $this->modal->create($requestedData);
    }

    public function deleteDataUnitById(int $id): bool
    {
        return Unit::destroy($id);
    }
}

?>
