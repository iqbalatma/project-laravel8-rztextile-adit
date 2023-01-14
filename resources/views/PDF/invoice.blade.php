<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>{{ $invoice->code }}</title>

  <style type="text/css">
    * {
      font-family: Verdana, Arial, sans-serif;
    }

    table {
      font-size: x-small;
    }

    tbody tr td {
      height: 20px;
    }

    tfoot tr td {
      font-weight: bold;
      font-size: x-small;
      padding-top: 10px;
    }

    .gray {
      background-color: lightgray
    }
  </style>

</head>

<body>

  <table width="100%">
    <tr>
      <td align="right">
        <h3>{{ $companyName }}</h3>
        <pre>
                {{ $companyAddress }}
                {{ $companyEmail }}
                {{ $companyPhone }}
        </pre>
      </td>
    </tr>

  </table>

  <table width="100%">
    <tr>
      <td><strong>From:</strong> {{ $companyName }} - {{ $invoice->user->name??"" }}</td>
      <td><strong>To:</strong> {{ $invoice->customer->name??"-" }}</td>
    </tr>

  </table>

  <br />

  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr>
        <th>No</th>
        <th>Item</th>
        <th>Quantity Roll</th>
        <th>Quantity Unit</th>
        <th>Unit Price</th>
        <th>Sub Total</th>
      </tr>
    </thead>
    <tbody>


      @foreach ($invoice->roll_transaction as $key => $transaction)
      <tr>
        <th>{{ $key+1 }}</th>
        <td>{{ $transaction->roll->name }}</td>
        <td align="center">{{ $transaction->quantity_roll }}</td>
        <td align="center">{{ $transaction->quantity_unit . " " . ($transaction->roll->unit->name ?? "") }}</td>
        <td align="center">{{ formatToRupiah($transaction->roll->selling_price) }}</td>
        <td align="center">{{ formatToRupiah($transaction->roll->selling_price * $transaction->quantity_unit) }}</td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td colspan="4"></td>
        <td align="right">Total</td>
        <td align="center">{{ formatToRupiah($invoice->total_bill) }}</td>
      </tr>
    </tfoot>
  </table>
  <br />
  <hr />
  <br />
  @if (count($invoice->payment)>0)
  <h5>Payment Histories</h5>
  <table width="100%" align="center">
    <thead style="background-color: lightgray;">
      <tr>
        <th>No</th>
        <th>Payment Code</th>
        <th>Paid Amount</th>
        <th>Payment Type</th>
        <th>Payment Date</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($invoice->payment as $key => $payment)
      <tr>
        <th>{{ $key+1 }}</th>
        <td>{{ $payment->code }}</td>
        <td align="center">{{ formatToRupiah($payment->paid_amount) }}</td>
        <td align="center">{{ ucfirst($payment->payment_type) }}</td>
        <td align="center">{{ $payment->created_at }}</td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td colspan="3"></td>
        <td align="right">Total Bill</td>
        <td align="center">{{ formatToRupiah($invoice->total_bill) }}</td>
      </tr>
      <tr>
        <td colspan="3"></td>
        <td align="right">Total Paid Amount</td>
        <td align="center">{{ formatToRupiah($invoice->total_paid_amount) }}</td>
      </tr>
      <tr>
        <td colspan="3"></td>
        <td align="right">Total Bill Left</td>
        <td align="center">{{ formatToRupiah($invoice->bill_left) }}</td>
      </tr>
    </tfoot>
  </table>
  @else
  <h5>No Payment Histories Available</h5>
  @endif

</body>

</html>