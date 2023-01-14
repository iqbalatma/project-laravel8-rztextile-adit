<?php 
namespace App\Services;

use App\Repositories\RollRepository;

class AjaxSearchRollService{

  /**
   * Description : use to get data roll by id
   * 
   * @param int $id
   * @return ?object
   */
  public function getShowData(int $id):?object
  {
    return (new RollRepository())->getDataRollById($id);
  }




}

?>