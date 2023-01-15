<?php

namespace Iqbalatma\RFMCalculation;

require "../vendor/autoload.php";
require "Abstracts/BaseRFMCalculation.php";
require "Interfaces/IRFMCalculation.php";

use Illuminate\Support\Collection;
use Iqbalatma\RFMCalculation\Abstracts\BaseRFMCalculation;
use Iqbalatma\RFMCalculation\Interfaces\IRFMCalculation;


class RFMCalculation extends BaseRFMCalculation implements IRFMCalculation
{
    public function __construct(
        Collection $datasetCustomer,
        string $recencyKey = "recency",
        string $frequencyKey = "total_invoices",
        string $moneteryKey = "total_bill",
        string $rfmKey = "total_rfm"
    ) {
        parent::__construct($datasetCustomer, $recencyKey, $frequencyKey, $moneteryKey, $rfmKey);
    }
    public function getRFM(): array
    {
        $recencyPoint = $this->getRecencyPointRange();
        $frequencyPoint = $this->getFrequencyPointRange();
        $moneteryPoint = $this->getMoneteryPointRange();


        $this->setRFMToDataSet($recencyPoint, $frequencyPoint, $moneteryPoint);
        $this->setRFMPointRange();

        $rfmPoint = $this->getRFMPointRange();
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
}
