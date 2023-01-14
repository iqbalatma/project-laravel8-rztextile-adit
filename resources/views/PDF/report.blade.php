<html>

<head>
  <title>{{ $title }}</title>

  <style>
    #table-all-sales {
      margin-left: -30px;
    }

    .table-sales td,
    .table-sales th,
    .table-sales,
      {
      border: 1.5px solid rgb(61, 61, 61);
      border-collapse: collapse;
      font-size: 12px;
      text-align: center;
      padding-left: 5px;
      padding-right: 5px;
      margin-top: 40px;
    }


    .table-sales th {
      background-color: #2c6faf;
      color: #ffffff;
    }

    .nowrap {
      white-space: nowrap;
    }
  </style>
</head>

<body>
  <h1 style="text-align: center">
    {{ $companyName }}
  </h1>
  <h6 style="text-align: center; margin-top: -20px">
    {{ $companyAddress }}
  </h6>
  <h6 style="text-align: center;margin-top: -20px">
    {{ $companyEmail }} | {{ $companyPhone }}
  </h6>

  <table>
    <tr>
      <td>Table Name</td>
      <td>: </td>
      <td>All Sales Data</td>
    </tr>
    <tr>
      <td>Total Invoice</td>
      <td>: </td>
      <td>{{ $sales_report["all_invoice"]["total_invoice"] }}</td>
    </tr>
    <tr>
      <td>Total Capital</td>
      <td>: </td>
      <td>{{ formatToRupiah($sales_report["all_invoice"]["total_capital"]) }}</td>
    </tr>
    <tr>
      <td>Total Bill</td>
      <td>: </td>
      <td>{{ formatToRupiah($sales_report["all_invoice"]["total_bill"]) }}</td>
    </tr>
    <tr>
      <td>Total Profit</td>
      <td>: </td>
      <td>{{ formatToRupiah($sales_report["all_invoice"]["total_profit"]) }}</td>
    </tr>
    <tr>
      <td>Total Paid Amount</td>
      <td>: </td>
      <td>{{ formatToRupiah($sales_report["all_invoice"]["total_paid_amount"]) }}</td>
    </tr>
    <tr>
      <td>Total Bill Left</td>
      <td>: </td>
      <td>{{ formatToRupiah($sales_report["all_invoice"]["total_bill_left"]) }}</td>
    </tr>
  </table>
  <table id="table-all-sales" class="table-sales">
    <thead>
      <tr>
        <th>No</th>
        <th style="white-space: nowrap;">Invoice Code</th>
        <th style="white-space: nowrap;">Capital</th>
        <th>Bill</th>
        <th>Profit</th>
        <th>Paid Amount</th>
        <th>Bill Left</th>
        <th>Payment Status</th>
        <th>Customer</th>
        <th>Admin</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($sales_report["all_invoice"]["invoice"] as $key => $invoice)
      <tr>
        <td>{{ $key+1 }}</td>
        <td class="nowrap">{{ $invoice->code }}</td>
        <td class="nowrap">{{ formatToRupiah($invoice->total_capital) }}</td>
        <td class="nowrap">{{ formatToRupiah($invoice->total_bill) }}</td>
        <td class="nowrap">{{ formatToRupiah($invoice->total_profit) }}</td>
        <td class="nowrap">{{ formatToRupiah($invoice->total_paid_amount) }}</td>
        <td class="nowrap">{{ formatToRupiah($invoice->bill_left) }}</td>
        <td>
          @if($invoice->is_paid_off)
          Lunas
          @else
          Belum Lunas
          @endif
        </td>
        <td>{{ $invoice->customer->name ?? "-" }}</td>
        <td>{{ $invoice->user->name ?? "-" }}</td>
        <td class="nowrap">{{ date('d-m-Y', strtotime($invoice->created_at)) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <br>
  <hr>
  <br>


  <table>
    <tr>
      <td>Table Name</td>
      <td>: </td>
      <td>Paid Off Sales</td>
    </tr>
    <tr>
      <td>Total Invoice</td>
      <td>: </td>
      <td>{{ $sales_report["paid_off_invoice"]["total_invoice"] }}</td>
    </tr>
    <tr>
      <td>Total Capital</td>
      <td>: </td>
      <td>{{ formatToRupiah($sales_report["paid_off_invoice"]["total_capital"]) }}</td>
    </tr>
    <tr>
      <td>Total Bill</td>
      <td>: </td>
      <td>{{ formatToRupiah($sales_report["paid_off_invoice"]["total_bill"]) }}</td>
    </tr>
    <tr>
      <td>Total Profit</td>
      <td>: </td>
      <td>{{ formatToRupiah($sales_report["paid_off_invoice"]["total_profit"]) }}</td>
    </tr>
    <tr>
      <td>Total Paid Amount</td>
      <td>: </td>
      <td>{{ formatToRupiah($sales_report["paid_off_invoice"]["total_paid_amount"]) }}</td>
    </tr>
    <tr>
      <td>Total Bill Left</td>
      <td>: </td>
      <td>{{ formatToRupiah($sales_report["paid_off_invoice"]["total_bill_left"]) }}</td>
    </tr>
  </table>
  <table id="table-paid-off-sales" class="table-sales">
    <thead>
      <tr>
        <th>No</th>
        <th style="white-space: nowrap;">Invoice Code</th>
        <th style="white-space: nowrap;">Capital</th>
        <th>Bill</th>
        <th>Profit</th>
        <th>Paid Amount</th>
        <th>Bill Left</th>
        <th>Customer</th>
        <th>Admin</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($sales_report["paid_off_invoice"]["invoice"] as $key => $invoice)
      <tr>
        <td>{{ $key+1 }}</td>
        <td class="nowrap">{{ $invoice->code }}</td>
        <td class="nowrap">{{ formatToRupiah($invoice->total_capital) }}</td>
        <td class="nowrap">{{ formatToRupiah($invoice->total_bill) }}</td>
        <td class="nowrap">{{ formatToRupiah($invoice->total_profit) }}</td>
        <td class="nowrap">{{ formatToRupiah($invoice->total_paid_amount) }}</td>
        <td class="nowrap">{{ formatToRupiah($invoice->bill_left) }}</td>
        <td>{{ $invoice->customer->name ?? "-" }}</td>
        <td>{{ $invoice->user->name ?? "-" }}</td>
        <td class="nowrap">{{ date('d-m-Y', strtotime($invoice->created_at)) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>


  <br>
  <hr>
  <br>
  <table>
    <tr>
      <td>Table Name</td>
      <td>: </td>
      <td>Not Paid Off Sales</td>
    </tr>
    <tr>
      <td>Total Invoice</td>
      <td>: </td>
      <td>{{ $sales_report["not_paid_off_invocie"]["total_invoice"] }}</td>
    </tr>
    <tr>
      <td>Total Capital</td>
      <td>: </td>
      <td>{{ formatToRupiah($sales_report["not_paid_off_invocie"]["total_capital"]) }}</td>
    </tr>
    <tr>
      <td>Total Bill</td>
      <td>: </td>
      <td>{{ formatToRupiah($sales_report["not_paid_off_invocie"]["total_bill"]) }}</td>
    </tr>
    <tr>
      <td>Total Profit</td>
      <td>: </td>
      <td>{{ formatToRupiah($sales_report["not_paid_off_invocie"]["total_profit"]) }}</td>
    </tr>
    <tr>
      <td>Total Paid Amount</td>
      <td>: </td>
      <td>{{ formatToRupiah($sales_report["not_paid_off_invocie"]["total_paid_amount"]) }}</td>
    </tr>
    <tr>
      <td>Total Bill Left</td>
      <td>: </td>
      <td>{{ formatToRupiah($sales_report["not_paid_off_invocie"]["total_bill_left"]) }}</td>
    </tr>
  </table>
  <table id="table-not-paid-off-sales" class="table-sales">
    <thead>
      <tr>
        <th>No</th>
        <th style="white-space: nowrap;">Invoice Code</th>
        <th style="white-space: nowrap;">Capital</th>
        <th>Bill</th>
        <th>Profit</th>
        <th>Paid Amount</th>
        <th>Bill Left</th>
        <th>Customer</th>
        <th>Admin</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($sales_report["not_paid_off_invocie"]["invoice"] as $key => $invoice)
      <tr>
        <td>{{ $key+1 }}</td>
        <td class="nowrap">{{ $invoice->code }}</td>
        <td class="nowrap">{{ formatToRupiah($invoice->total_capital) }}</td>
        <td class="nowrap">{{ formatToRupiah($invoice->total_bill) }}</td>
        <td class="nowrap">{{ formatToRupiah($invoice->total_profit) }}</td>
        <td class="nowrap">{{ formatToRupiah($invoice->total_paid_amount) }}</td>
        <td class="nowrap">{{ formatToRupiah($invoice->bill_left) }}</td>
        <td>{{ $invoice->customer->name ?? "-" }}</td>
        <td>{{ $invoice->user->name ?? "-" }}</td>
        <td class="nowrap">{{ date('d-m-Y', strtotime($invoice->created_at)) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>