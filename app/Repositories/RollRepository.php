<?php
namespace App\Repositories;

use App\AppData;
use App\Models\Roll;
use Illuminate\Support\Facades\DB;

class RollRepository
{

    public function getAllDataRollPaginated(
        string|bool $search = false,
        string|bool $year = false,
        string|bool $month = false,
        array $columns = ["*"],
        int $perPage = AppData::DEFAULT_PERPAGE
    ): ?object
    {
        $rolls = Roll::select($columns);

        if ($year && $month) {
            $rolls->whereYear("updated_at", "=", $year)->whereMonth("updated_at", "=", $month);
        }

        if ($search) {
            $rolls->where("name", "LIKE", "%$search%")
                ->orWhere("code", "LIKE", "%$search%")
                ->orWhere("qrcode", "LIKE", "%$search%")
                ->orWhereHas("unit", function ($query) use ($search, $year, $month) {
                    $query->where("name", "LIKE", "%$search%");

                    if ($year && $month) {
                        $query->whereHas(
                            "roll",
                            function ($subquery) use ($year, $month) {
                                    $subquery->whereYear("updated_at", "=", $year)->whereMonth("updated_at", "=", $month);
                                }
                        );
                    }
                });
        }

        $rolls = $rolls->paginate($perPage)->appends(request()->query());

        return $rolls;
    }

    public function getAllDataRoll(array $columns = ["*"])
    {
        return Roll::with([
            "unit" => function ($query) {
                $query->select(["id", "name"]);
            }])->select($columns)->get();
    }

    public function getLeastRoll(int $limit = 5, array $columns = ["*"])
    {
        return Roll::with("unit")
            ->orderBy("quantity_unit", "ASC")
            ->limit($limit)
            ->get($columns);
    }

    public function getDataRollByIds(array $ids, array $columns = ["*"])
    {
        return Roll::select($columns)->whereIn("id", $ids)->get();
    }

    public function addNewDataRoll(array $requestedData): object
    {
        return Roll::create($requestedData);
    }

    public function getDataRollById(int $id, array $columns = ["*"]): ?object
    {
        return Roll::with("unit")->select($columns)->find($id);
    }

    public function updateDataRollById(int $id, array $requestedData): bool
    {
        return Roll::where("id", $id)->update($requestedData);
    }

    public function increaseQuantityRollAndUnit(int $id, int $quantityRoll = 0, int $quantityUnit = 0)
    {
        return Roll::where("id", $id)->update([
            "quantity_roll" => DB::raw("quantity_roll+$quantityRoll"),
            "quantity_unit" => DB::raw("quantity_unit+$quantityUnit"),
        ]);
    }

    public function decreaseQuantityRollAndUnit(int $id, int $quantityRoll = 0, int $quantityUnit = 0)
    {
        return Roll::where("id", $id)->update([
            "quantity_roll" => DB::raw("quantity_roll-$quantityRoll"),
            "quantity_unit" => DB::raw("quantity_unit-$quantityUnit"),
        ]);
    }
}

?>
