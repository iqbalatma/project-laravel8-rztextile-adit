<?php
namespace App\Repositories;

use App\AppData;
use App\Models\Payment;
use Carbon\Carbon;

class PaymentRepository
{

    public function getAllDataPaymentPaginated(
        string $type = "all",
        string|bool $search = false,
        string|bool $year = false,
        string|bool $month = false,
        array $columns = ["*"],
        int $perPage = AppData::DEFAULT_PERPAGE
    ): ?object
    {
        $payments = Payment::with("user", "invoice.customer")
            ->select($columns)
            ->orderBy("created_at", "DESC");

        if ($type !== "all") {
            $payments->where("payment_type", $type);
        }


        if ($year && $month) {
            $payments->whereYear("created_at", "=", $year)->whereMonth("created_at", "=", $month);
        }

        if ($search) {
            $payments->where("code", "LIKE", "%$search%")
                ->orWhereHas("user", function ($query) use ($search, $year, $month) {
                    $query->where("name", "LIKE", "%$search%");
                    if ($year && $month) {
                        $query->whereHas(
                            "payment",
                            function ($subQuery) use ($year, $month) {
                                    $subQuery->whereYear("created_at", "=", $year)->whereMonth("created_at", "=", $month);
                                }
                        );
                    }
                })
                ->orWhereHas("invoice", function ($query) use ($search, $year, $month) {
                    $query->where("code", "LIKE", "%$search%");

                    if ($year && $month) {
                        $query->whereHas(
                            "payment",
                            function ($subQuery) use ($year, $month) {
                                    $subQuery->whereYear("created_at", "=", $year)->whereMonth("created_at", "=", $month);
                                }
                        );
                    }
                })->orWhereHas(
                    "invoice.customer",
                    function ($query) use ($search, $year, $month) {
                        $query->where("name", "LIKE", "%$search%");

                        if ($year && $month) {
                            $query->whereHas(
                                "payment",
                                function ($subQuery) use ($year, $month) {
                                            $subQuery->whereYear("created_at", "=", $year)->whereMonth("created_at", "=", $month);
                                        }
                            );
                        }
                    }
                );

        }


        $payments = $payments->paginate($perPage)
            ->appends(request()->query());

        return $payments;
    }

    public function getDataLatestPayment(int $limit = 5, array $columns = ["*"])
    {
        return Payment::with("user")
            ->orderBy("created_at", "DESC")
            ->limit($limit)
            ->get($columns);
    }

    public function getLatestDataPaymentThisMonth(array $columns = ["*"]): ?object
    {
        $now = Carbon::now();
        return Payment::select($columns)
            ->whereYear("created_at", "=", $now->year)
            ->whereMonth("created_at", "=", $now->month)
            ->orderBy("created_at", "DESC")
            ->first();
    }

    public function addNewDataPayment(array $requestedData): ?object
    {
        return Payment::create($requestedData);
    }

}

?>
