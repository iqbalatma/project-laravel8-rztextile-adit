<?php
namespace App\Services;

use App\Repositories\RollRepository;

class SearchRollService
{

    /**
     * Description : use to get all data for index controller
     *
     * @return array
     */
    public function getAllData()
    {
        return [
            "title"       => "Search Roll",
            "description" => "Form search roll",
            "cardTitle"   => "Search Roll",
            "rolls"       => (new RollRepository())->getAllDataRoll()
        ];
    }
}

?>
