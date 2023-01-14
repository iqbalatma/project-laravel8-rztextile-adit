<?php
namespace App\Services;

use App\AppData;
use App\Repositories\InvoiceRepository;

class InvoiceService
{

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
        $invoiceRepository = new InvoiceRepository();

        $invoices = $invoiceRepository->getAllDataInvoicePaginated(type: $type, search: $search, month: $month, year: $year);

        return [
            "title"       => "Invoice",
            "description" => "Invoice transaction list",
            "cardTitle"   => "Invoices",
            "invoices"    => $invoices,

        ];
    }

    public function reduceBill(int $invoiceId, int $paidAmount): void
    {
        $invoice = (new InvoiceRepository())->getDataInvoiceById($invoiceId);

        if ($paidAmount >= $invoice->bill_left) {
            $paidAmount = $invoice->bill_left;
            $invoice->is_paid_off = true;
        }
        $invoice->bill_left -= $paidAmount;
        $invoice->total_paid_amount += $paidAmount;
        $invoice->save();
    }

    public function download(int $invoiceId)
    {
        $invoice = (new InvoiceRepository())->getDataInvoiceById($invoiceId);
        return [
            "invoice"        => $invoice,
            "companyName"    => AppData::COMPANY_NAME,
            "companyAddress" => AppData::COMPANY_ADDRESS,
            "companyPhone"   => AppData::COMPANY_PHONE,
            "companyEmail"   => AppData::COMPANY_EMAIL,
        ];
    }
}

?>
