<?php

namespace App\Services;

use App\Repositories\InvoiceRepository;
use Carbon\Carbon;

class RFMService
{

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
        $now = Carbon::now();
        $datasetCustomer = (new InvoiceRepository())->getDataInvoiceForRFM();

        if (count($datasetCustomer) == 0) {
            return [];
        }
        $customer = collect($datasetCustomer)->map(function ($item) use ($now) {
            $item["recency"] = Carbon::parse($item["latest_invoice_date"])->diffInDays($now);
            return $item;
        });

        $maxR = $customer->max("recency");
        $maxF = $customer->max("total_invoices");
        $maxM = $customer->max("total_bill");

        $recencyPoint = $this->getRangePoint($maxR);
        $frequencyPoint = $this->getRangePoint($maxF);
        $moneteryPoint = $this->getRangePoint($maxM);
        $customer = $customer->map(function ($item) use ($recencyPoint, $frequencyPoint, $moneteryPoint) {
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

        $maxRFM = $customer->max("total_rfm");


        $rfmPoint = $this->getRangePoint($maxRFM, 4);
        $maping = ["bz", "m", "mgc", "mvc"];
        $customerDistribution = ["bz"  => [], "m"   => [], "mgc" => [], "mvc" => []];
        foreach ($customer as $key => $value) {
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

    private function getRangePoint(int $maxValue, int $divider = 5): array
    {
        $rangePoint = [];

        for ($i = 1; $i <= $divider; $i++) {
            array_push($rangePoint, ["lower_threshold" => $maxValue / $divider * ($i - 1), "upper_threshold" => $maxValue / $divider * $i]);
        }
        return $rangePoint;
    }

}

?>
