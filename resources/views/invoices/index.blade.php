<x-dashboard.layout title="{{ $title }}" description="{{ $description }}">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-file-invoice-dollar"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <form action="{{ route('invoices.index') }}">
                        <div class="row">
                            <div class="col-md-8">
                                <input id="bday-month" class="form-control" type="month" name="month_year" value="{{ request()->input('month_year') ??'' }}" required />
                            </div>
                            <div class="col-md-4">
                                <input type="hidden" name="type" value="{{ request()->input('type', 'all') }}">
                                @if (request()->input('search'))
                                <input type="hidden" name="search" value="{{ request()->input('search') }}">
                                @endif
                                <button class="btn btn-primary"><i class="fa-solid fa-filter"></i> Filter</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-10">
                            <form action="{{ route('invoices.index') }}">
                                <div class="input-group mb-3">
                                    <input type="hidden" name="type" value="{{ request()->input('type', 'all') }}">
                                    @if (request()->input('month_year'))
                                    <input type="hidden" name="month_year" value="{{ request()->input('month_year') }}">
                                    @endif
                                    <input type="text" name="search" class="form-control" placeholder="What are you looking for ?" aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{ request()->input('search') ?? ''}}" required>
                                    <button class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i>Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2">
                            <form action="{{ route('invoices.index') }}">
                                <input type="hidden" name="type" value="{{ request()->input('type', 'all') }}">
                                <button class="btn btn-primary">Reset</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link @if (request()->input('type')=='all' || is_null(request()->input('type')) ) active @endif" aria-current="page" href="{{ route('invoices.index',['type'=>'all']) }}">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (request()->input('type')=='not-paid-off') active @endif" href="{{ route('invoices.index',['type'=>'not-paid-off']) }}">Not Paid Off</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (request()->input('type')=='paid-off') active @endif" href="{{ route('invoices.index',['type'=>'paid-off']) }}">Paid Off</a>
                </li>
            </ul>



            @if (count($invoices) == 0)
            <x-data-not-found></x-data-not-found>
            @else
            {{-- Table Data Invoice --}}
            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead>
                        <th>No</th>
                        <th>Code</th>
                        <th>Capital</th>
                        <th>Bill</th>
                        <th>Profit</th>
                        <th>Paid Amount</th>
                        <th>Bill Left</th>
                        <th>Customer</th>
                        <th>Admin</th>
                        <th>Is Paid Off</th>
                        <th>Last Updated Time</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $key => $invoice)
                        <tr>
                            <td>{{ $invoices->firstItem()+$key }}</td>
                            <td class="text-nowrap">{{ $invoice->code }}</td>
                            <td class="text-nowrap">{{ formatToRupiah($invoice->total_capital) }}</td>
                            <td class="text-nowrap">{{ formatToRupiah($invoice->total_bill) }}</td>
                            <td class="text-nowrap">{{ formatToRupiah($invoice->total_profit) }}</td>
                            <td class="text-nowrap">{{ formatToRupiah($invoice->total_paid_amount) }}</td>
                            <td class="text-nowrap">{{ formatToRupiah($invoice->bill_left) }}</td>
                            <td>{{ $invoice->customer->name??"-" }}</td>
                            <td>{{ $invoice->user->name??"-" }}</td>
                            <td>
                                @if ($invoice->is_paid_off)
                                <span class="badge bg-success">Paid Off</span>
                                @else
                                <span class="badge bg-danger">Not Paid Off</span>
                                @endif
                            </td>
                            <td>{{ $invoice->updated_at }}</td>
                            <td>
                                <div class="d-grid gap-2 d-md-flex">
                                    <a href="{{ route('invoices.invoicPdf', ['id'=> $invoice->id, 'type'=>'download']) }}" class="btn btn-success">
                                        <i class="fa-solid fa-download"></i>
                                    </a>

                                    @if (!$invoice->is_paid_off)
                                    <a href="{{ route('payments.createByInvoiceId', $invoice->id) }}" class="btn btn-primary"><i class="fa-solid fa-money-bill"></i></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $invoices->links() }}
            </div>
            @endif
        </div>
    </div>
</x-dashboard.layout>
