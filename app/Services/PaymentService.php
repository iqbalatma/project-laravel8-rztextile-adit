<?php
namespace App\Services;

use App\Repositories\InvoiceRepository;
use App\Repositories\PaymentRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentService
{
    private const PREFIX_CODE = "PYMNT-";
    /**
     * Description : use to get all data for index controller
     *
     * @return array
     */
    public function getAllData(): array
    {
        $type = request()->input("type", "all");
        $search = request()->input("search", false) ?? false;
        $monthYear = request()->input("month_year", false) ?? false;
        $month = false;
        $year = false;
        if ($monthYear) {
            $monthYear = explode("-", $monthYear);
            $month = $monthYear[1];
            $year = $monthYear[0];
        }


        return [
            "title"       => "Payment",
            "description" => "Data payment by invoice",
            "cardTitle"   => "Payments",
            "type"        => $type,
            "payments"    => (new PaymentRepository())->getAllDataPaymentPaginated($type, $search, $year, $month)
        ];
    }


    /**
     * Description : use to get data for create form by invoice id
     *
     * @param int $invoiceId
     * @return array
     */
    public function getDataCreateByInvoiceId(int $invoiceId): array
    {
        return [
            "title"       => "Payment",
            "description" => "Form for add new payment by invoice",
            "cardTitle"   => "Payments",
            "invoice"     => (new InvoiceRepository())->getDataInvoiceById($invoiceId)
        ];
    }


    /**
     * Description : use to get data for view create data
     *
     * @return array of data for create form
     */
    public function getCreateData(): array
    {
        return [
            "title"       => "Payment",
            "description" => "Add new payment by invoice",
            "cardTitle"   => "Payments",
            "invoices"    => (new InvoiceRepository())->getDataUnpaidInvoice()
        ];
    }


    /**
     * Description : use to store new data payment on unfinished payment
     *
     * @param array $requestedData from client
     * @return int total change
     */
    public function storeNewData(array $requestedData): int
    {
        $change = 0;
        $requestedData["code"] = $this->getGeneratedPaymentCode();
        $requestedData["user_id"] = Auth::user()->id;
        if ($requestedData["paid_amount"] >= $requestedData["bill_left"]) {
            $change = $requestedData["paid_amount"] - $requestedData["bill_left"];
            $requestedData["paid_amount"] = $requestedData["bill_left"];
        }
        try {
            DB::beginTransaction();
            (new InvoiceService())->reduceBill($requestedData["invoice_id"], $requestedData["paid_amount"]);
            (new PaymentRepository())->addNewDataPayment($requestedData);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return $change;
    }


    /**
     * Description : use to generated payment code
     *
     * @return string of generated payment code
     */
    public function getGeneratedPaymentCode(): string
    {
        $newCode = self::PREFIX_CODE . Carbon::now()->format("Y-m") . "-"; #ex : PYMNT-2022-11-
        $latestPaymentThisMonth = (new PaymentRepository())->getLatestDataPaymentThisMonth();

        if ($latestPaymentThisMonth) {
            $latestCode = explode('-', $latestPaymentThisMonth->code);
            $newCode .= getIncreasedDigitNumber(end($latestCode));
        } else {
            $newCode .= "0001";
        }

        return $newCode;
    }
}
?>
