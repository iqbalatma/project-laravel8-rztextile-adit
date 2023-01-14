<?php 
namespace App\Services;

use App\Repositories\InvoiceRepository;
use Carbon\Carbon;

class AjaxDashboardService{

  public function getSummarySalesData():array
  {
    $period = $this->getPeriod();
    return [
      "period" => $period,
      "month" => Carbon::now()->format("F"),
      "total_bill" => $this->getTotalBill($period),
      "total_profit" => $this->getTotalProfit($period),
      "total_capital" => $this->getTotalCapital($period),
      "tes" => (new InvoiceRepository())->getAllDataInvoiceTotalBillThisMonth()
    ];
  }

  private function getTotalCapital($period)
  {
    $dataset =  (new InvoiceRepository())->getAllDataInvoiceTotalCapitalThisMonth();
    $totalCapital = [];
    foreach ($period as $key => $value) {
      $exists = false;
      foreach ($dataset as $subKey => $subValue) {
        if(intval($subValue->date) == $value){
          array_push($totalCapital, $subValue->total);
          unset($dataset[$subKey]);
          $exists = true;
          break;
        }
      }

      if(!$exists){
        array_push($totalCapital, null);
      }
    }
    return $totalCapital;
  }

  private function getTotalProfit(array $period)
  {
    $dataset = (new InvoiceRepository())->getAllDataInvoiceTotalProfitThisMonth();
    $totalProfit = [];
    foreach ($period as $key => $value) {
      $exists = false;
      foreach ($dataset as $subKey => $subValue) {
        if(intval($subValue->date) == $value){
          array_push($totalProfit, $subValue->total);
          unset($dataset[$subKey]);
          $exists = true;
          break;
        }
      }

      if(!$exists){
        array_push($totalProfit, null);
      }
    }
    return $totalProfit;
  }

  private function getTotalBill(array $period)
  {
    $dataset = (new InvoiceRepository())->getAllDataInvoiceTotalBillThisMonth();
    $totalBill = [];
    foreach ($period as $key => $value) {
      $exists = false;
      foreach ($dataset as $subKey => $subValue) {
        if(intval($subValue->date) == $value){
          array_push($totalBill, $subValue->total);
          unset($dataset[$subKey]);
          $exists = true;
          break;
        }
      }

      if(!$exists){
        array_push($totalBill, null);
      }
    }
    return $totalBill;
  }

  private function getPeriod()
  {
    $endDate = Carbon::now()->endOfMonth()->format("d");

    $period = [];
    for ($i=1; $i <= $endDate; $i++) { 
      array_push($period, $i);
    }
    return $period;
  }

}

?>