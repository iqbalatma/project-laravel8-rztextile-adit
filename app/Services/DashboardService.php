<?php
namespace App\Services;

use App\Repositories\InvoiceRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\RollRepository;
use Carbon\Carbon;

class DashboardService
{
    public function getAllData()
    {
        $invoiceRepository = (new InvoiceRepository());
        return [
            "title"           => "Dashboard",
            "description"     => "Transaction and finance summary chart and table",
            "total_invoices"  => $invoiceRepository->getTotalInvoiceMonthly(),
            "total_bill_left" => formatToRupiah($invoiceRepository->getTotalBillLeftMonthly()),
            "total_profit"    => formatToRupiah($invoiceRepository->getTotalProfitMonthly()),
            "total_capital"   => formatToRupiah($invoiceRepository->getTotalCapitalMonthly()),
            "currentMonth"    => Carbon::now()->format("F"),
            "latestInvoices"  => $invoiceRepository->getDataLatestInvoice(),
            "latestPayments"  => (new PaymentRepository())->getDataLatestPayment(),
            "leastRolls"      => (new RollRepository())->getLeastRoll()
        ];
    }
}
?>
