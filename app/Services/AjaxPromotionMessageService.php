<?php

namespace App\Services;

use App\Repositories\PromotionMessageRepository;

class AjaxPromotionMessageService
{


  /**
   * Description : use to get data by id
   * 
   * @param int $id
   * @return ?object eloquent model
   */
  public function getShowData(int $id): ?object
  {
    return (new PromotionMessageRepository())->getDataPromotionMessageById($id);
  }
}
