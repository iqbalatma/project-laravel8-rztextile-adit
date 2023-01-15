<?php

namespace Iqbalatma\RFMCalculation\Abstracts;

use Illuminate\Support\Collection;

abstract class BaseRFMCalculation
{
    protected $datasetCustomer;
    protected array $rfmPointRange = [];
    protected array $recencyPointRange = [];
    protected array $frequencyPointRange = [];
    protected array $moneteryPointRange = [];
    protected const DEFAULT_DIVIDER = 5;
    private string $recencyKey;
    private string $frequencyKey;
    private string $moneteryKey;
    private string $rfmKey;


    public function __construct(
        Collection $datasetCustomer,
        string $recencyKey,
        string $frequencyKey,
        string $moneteryKey,
        string $rfmKey
    ) {
        $this->datasetCustomer = $datasetCustomer;
        $this->recencyKey = $recencyKey;
        $this->frequencyKey = $frequencyKey;
        $this->moneteryKey = $moneteryKey;
        $this->rfmKey = $rfmKey;
        $this->setRecencyPointRange();
        $this->setFrequencyPointRange();
        $this->setMoneteryPointRange();
    }
    protected function getRangePoint(int $maxValue, int $divider = self::DEFAULT_DIVIDER, bool $isReverse = false): array
    {
        $rangePoint = [];
        for ($i = 1; $i <= $divider; $i++) {
            array_push($rangePoint, [
                "lower_threshold" => $maxValue / $divider * ($i - 1),
                "upper_threshold" => $maxValue / $divider * $i
            ]);
        }

        $isReverse ?? $rangePoint = array_reverse($rangePoint);
        return $rangePoint;
    }

    protected function setRecencyPointRange(): void
    {
        $maxR = $this->datasetCustomer->max($this->recencyKey);
        $this->recencyPointRange = $this->getRangePoint($maxR, isReverse: true);
    }
    public function getRecencyPointRange(): array
    {
        return $this->recencyPointRange;
    }
    protected function setFrequencyPointRange(): void
    {
        $maxF = $this->datasetCustomer->max($this->frequencyKey);
        $this->frequencyPointRange = $this->getRangePoint($maxF);
    }

    public function getFrequencyPointRange(): array
    {
        return $this->frequencyPointRange;
    }

    protected function setMoneteryPointRange(): void
    {
        $maxM = $this->datasetCustomer->max($this->moneteryKey);
        $this->moneteryPointRange = $this->getRangePoint($maxM);
    }
    public function getMoneteryPointRange(): array
    {
        return $this->moneteryPointRange;
    }


    public function setRFMPointRange(): void
    {
        $maxRFM = $this->datasetCustomer->max($this->rfmKey);
        $this->rfmPointRange =  $this->getRangePoint($maxRFM, 4);
    }
    public function getRFMPointRange(): array
    {
        return $this->rfmPointRange;
    }
}
