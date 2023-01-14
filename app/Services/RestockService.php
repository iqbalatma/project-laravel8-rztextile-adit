<?php
namespace App\Services;

use App\Repositories\RollRepository;
use App\Repositories\RollTransactionRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RestockService
{

    /**
     * Description : use to get all data for index controller
     *
     * @return array
     */
    public function getAllData(): array
    {
        return [
            "title"       => "Restock",
            "description" => "Form for add new stock into warehouse",
            "cardTitle"   => "Restock",
            "rolls"       => (new RollRepository())->getAllDataRoll()
        ];
    }


    /**
     * Description : use to restock data roll
     *
     * @param array $requestedData
     * @return object
     */
    public function storeNewRestock(array $requestedData): ?object
    {
        $requestedData["type"] = "restock";
        $requestedData["user_id"] = Auth::user()->id;

        try {
            DB::beginTransaction();
            (new RollRepository())->increaseQuantityRollAndUnit(
                $requestedData["roll_id"],
                $requestedData["quantity_roll"],
                $requestedData["quantity_unit"]
            );

            $rollTransaction = (new RollTransactionRepository())->addNewDataRollTransaction($requestedData);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return $rollTransaction;
    }

}

?>
