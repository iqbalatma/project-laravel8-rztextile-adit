<?php

namespace App\Services;

use App\Repositories\InvoiceRepository;
use Carbon\Carbon;

class RFMService2
{
    private const DIVIDER = 5;
    private $datasetCustomer;
    private $isDataExists = false;

    public function __construct()
    {
        // get data from database
        $this->datasetCustomer = (new InvoiceRepository())->getDataInvoiceForRFM();

        // check is data exists and parse recency data
        if (count($this->datasetCustomer) > 0) {
            $this->isDataExists = true;
            $this->datasetCustomer = collect($this->datasetCustomer)->map(function ($item) {
                $item["recency"] = Carbon::parse($item["latest_invoice_date"])->diffInDays(Carbon::now());
                return $item;
            });
        }
    }


    /**
     * Summary of getRFM
     * NOTES : this can be improved by add summary transaction invoice and amount of bill every new transaction
     * so you can create column for summary
     * total_invoice
     * total_bill_amount
     * and then you can get their latest transaction
     * @return
     */
    public function getRFM(): array
    {
        if (!$this->isDataExists()) {
            return [];
        }

        $recencyPoint = $this->getRecencyPoint();
        $frequencyPoint = $this->getFrequencyPoint();
        $moneteryPoint = $this->getMoneteryPoint();

        $this->setRFMToDataSet($recencyPoint, $frequencyPoint, $moneteryPoint);


        $rfmPoint = $this->getRFMPoint();
        $maping = ["bz", "m", "mgc", "mvc"];
        $customerDistribution = ["bz"  => [], "m"   => [], "mgc" => [], "mvc" => []];
        foreach ($this->datasetCustomer as $key => $value) {
            foreach ($rfmPoint as $subKey => $subValue) {
                if (count($rfmPoint) - 1 == $subKey) {
                    if ($value["total_rfm"] >= $subValue["lower_threshold"] && $value["total_rfm"] <= $subValue["upper_threshold"]) {
                        array_push($customerDistribution[$maping[$subKey]], $value);
                    }
                } else {
                    if ($value["total_rfm"] >= $subValue["lower_threshold"] && $value["total_rfm"] < $subValue["upper_threshold"]) {
                        array_push($customerDistribution[$maping[$subKey]], $value);
                    }
                }
            }
        }

        return [
            "customers"      => $customerDistribution,
            "recencyPoint"   => $recencyPoint,
            "frequencyPoint" => $frequencyPoint,
            "moneteryPoint"  => $moneteryPoint,
            "rfmPoint"       => $rfmPoint,
        ];
    }

    public function setRFMToDataSet(array $recencyPoint, array $frequencyPoint, array $moneteryPoint): void
    {
        $this->datasetCustomer = $this->datasetCustomer->map(function ($item) use ($recencyPoint, $frequencyPoint, $moneteryPoint) {
            $item["total_rfm"] = 0;
            if ($recencyPoint[0]["lower_threshold"] == 0 && $recencyPoint[0]["upper_threshold"] == 0) {
                $item["total_rfm"] += 1;
            } else {
                foreach ($recencyPoint as $key => $value) {
                    if (count($recencyPoint) - 1 == $key) {
                        if ($item["recency"] >= $value["lower_threshold"] && $item["recency"] <= $value["upper_threshold"]) {
                            $item["total_rfm"] += $key + 1;
                        }
                    } else {
                        if ($item["recency"] >= $value["lower_threshold"] && $item["recency"] < $value["upper_threshold"]) {
                            $item["total_rfm"] += $key + 1;
                        }
                    }
                }
            }

            if ($frequencyPoint[0]["lower_threshold"] == 0 && $frequencyPoint[0]["upper_threshold"] == 0) {
                $item["total_rfm"] += 1;
            } else {
                foreach ($frequencyPoint as $key => $value) {
                    if (count($frequencyPoint) - 1 == $key) {
                        if ($item["total_invoices"] >= $value["lower_threshold"] && $item["total_invoices"] <= $value["upper_threshold"]) {
                            $item["total_rfm"] += $key + 1;
                        }
                    } else {
                        if ($item["total_invoices"] >= $value["lower_threshold"] && $item["total_invoices"] < $value["upper_threshold"]) {
                            $item["total_rfm"] += $key + 1;
                        }
                    }
                }
            }

            if ($moneteryPoint[0]["lower_threshold"] == 0 && $moneteryPoint[0]["upper_threshold"] == 0) {
                $item["total_rfm"] += 1;
            } else {
                foreach ($moneteryPoint as $key => $value) {
                    if (count($moneteryPoint) - 1 == $key) {
                        if ($item["total_bill"] >= $value["lower_threshold"] && $item["total_bill"] <= $value["upper_threshold"]) {
                            $item["total_rfm"] += $key + 1;
                        }
                    } else {
                        if ($item["total_bill"] >= $value["lower_threshold"] && $item["total_bill"] < $value["upper_threshold"]) {
                            $item["total_rfm"] += $key + 1;
                        }
                    }
                }
            }

            return $item;
        });
    }

    private function isDataExists(): bool
    {
        return $this->isDataExists;
    }

    private function getRecencyPoint(): array
    {
        $maxR = $this->datasetCustomer->max("recency");
        return $this->getRangePoint($maxR, isReverse: true);
    }

    private function getFrequencyPoint(): array
    {
        $maxF = $this->datasetCustomer->max("total_invoices");
        return $this->getRangePoint($maxF);
    }

    public function getMoneteryPoint(): array
    {
        $maxM = $this->datasetCustomer->max("total_bill");
        return $this->getRangePoint($maxM);
    }

    public function getRFMPoint(): array
    {
        $maxRFM = $this->datasetCustomer->max("total_rfm");
        return  $this->getRangePoint($maxRFM, 4);
    }
    private function getRangePoint(int $maxValue, int $divider = self::DIVIDER, bool $isReverse = false): array
    {
        $rangePoint = [];
        for ($i = 1; $i <= $divider; $i++) {
            array_push($rangePoint, [
                "lower_threshold" => $maxValue / $divider * ($i - 1),
                "upper_threshold" => $maxValue / $divider * $i
            ]);
        }
        if ($isReverse) {
            $rangePoint = array_reverse($rangePoint);
        }
        return $rangePoint;
    }
}
