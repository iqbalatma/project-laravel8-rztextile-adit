<?php

namespace App\Services;

require base_path() . "/library/RFMCalculation/src/RFMCalculation.php";

use App\Repositories\InvoiceRepository;
use Carbon\Carbon;
use Iqbalatma\RFMCalculation\RFMCalculation;

class RFMService
{
    private $dataCustomer;
    private $dataRFM = [];
    private $isDataExists;
    public function __construct()
    {
        $this->dataCustomer = (new InvoiceRepository())->getDataInvoiceForRFM();
        if ($this->dataCustomer->count()) {
            $this->dataCustomer = collect($this->dataCustomer)->map(function ($item) {
                $item["recency"] = Carbon::parse($item["latest_invoice_date"])->diffInDays(Carbon::now());
                return $item;
            });
            $rfmCalculation = new RFMCalculation($this->dataCustomer);
            $this->dataRFM = $rfmCalculation->getRFM();
        };
    }

    public function getRFM()
    {
        return $this->dataRFM;
    }
}
