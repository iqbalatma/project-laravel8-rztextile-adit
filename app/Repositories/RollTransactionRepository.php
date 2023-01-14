<?php
namespace App\Repositories;

use App\AppData;
use App\Models\RollTransaction;

class RollTransactionRepository
{

    public function getAllDataRollTransactionPaginated(
        string|bool $type = "all",
        string|bool $search = false,
        string|bool $year = false,
        string|bool $month = false,
        array $columns = ["*"],
        int $perPage = AppData::DEFAULT_PERPAGE
    ): ?object
    {
        $rollTransactions = RollTransaction::with("invoice")
            ->select($columns)
            ->orderBy("created_at", "DESC");

        if ($type != "all") {
            $rollTransactions->where("type", "=", $type);
        }


        if ($search) {
            $rollTransactions->orWhereHas("invoice", function ($query) use ($search, $year, $month) {
                return $query->where("code", "LIKE", "%$search%")->whereHas(
                    "roll_transaction",
                    function ($subQuery) use ($year, $month) {
                        return $subQuery->whereYear("created_at", "=", $year)->whereMonth("created_at", "=", $month);
                    }
                );
            })
                ->orWhereHas("roll", function ($query) use ($search, $year, $month) {
                    return $query->where("code", "LIKE", "%$search%")
                        ->where("name", "LIKE", "%$search%")
                        ->orWhereHas(
                            "unit",
                            function ($subQuery) use ($search) {
                                    return $subQuery->where("name", "LIKE", "%$search%");
                                }
                        )->whereHas(
                            "roll_transaction",
                            function ($subQuery) use ($year, $month) {
                                    return $subQuery->whereYear("created_at", "=", $year)->whereMonth("created_at", "=", $month);
                                }
                        );
                    ;
                })
                ->orWhereHas("user", function ($query) use ($search, $year, $month) {
                    return $query->where("name", "LIKE", "%$search%")->whereHas(
                        "roll_transaction",
                        function ($subQuery) use ($year, $month) {
                                return $subQuery->whereYear("created_at", "=", $year)->whereMonth("created_at", "=", $month);
                            }
                    );
                });
        }

        if ($year && $month) {
            $rollTransactions->whereYear("created_at", "=", $year)->whereMonth("created_at", "=", $month);
        }



        $rollTransactions = $rollTransactions->paginate($perPage)->appends(request()->query());

        return $rollTransactions;
    }

    public function getDataRollTransactionRestockPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE): ?object
    {
        return RollTransaction::with("invoice")
            ->select($columns)
            ->where("type", "restock")
            ->orderBy("created_at", "DESC")
            ->paginate($perPage)
            ->appends(request()->query());
    }


    public function getDataRollTransactionSoldPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE): ?object
    {
        return RollTransaction::with("invoice")
            ->select($columns)
            ->where("type", "sold")
            ->orderBy("created_at", "DESC")
            ->paginate($perPage)
            ->appends(request()->query());
    }


    public function getDataRollTransactionBrokenPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE): ?object
    {
        return RollTransaction::with("invoice")
            ->select($columns)
            ->where("type", "broken")
            ->orderBy("created_at", "DESC")
            ->paginate($perPage)
            ->appends(request()->query());
    }

    public function addNewDataRollTransaction(array $requestedData): ?object
    {
        return RollTransaction::create($requestedData);
    }
}

?>
