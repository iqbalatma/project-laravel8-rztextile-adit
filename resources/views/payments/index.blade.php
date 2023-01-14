<x-dashboard.layout title="{{ $title }}" description="{{ $description }}">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-file-invoice-dollar"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4">
                <a href="{{ route('payments.create') }}" type="button" class="btn btn-primary">
                    <i class="fa-solid fa-square-plus"></i>
                    Add New Payment</a>
            </div>

            {{-- Search and filter Form --}}
            <div class="row">
                <div class="col-md-4">
                    <form action="{{ route('payments.index') }}">
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
                            <form action="{{ route('payments.index') }}">
                                <div class="input-group mb-3">
                                    <input type="hidden" name="type" value="{{ request()->input('type')??'all' }}">
                                    @if (request()->input('month_year'))
                                    <input type="hidden" name="month_year" value="{{ request()->input('month_year')??'' }}">
                                    @endif
                                    <input type="text" class="form-control" placeholder="What are you looking for ?" name="search" value="{{ request()->input('search')??'' }}">
                                    <button class="btn btn-primary">
                                        <i class="fa-solid fa-magnifying-glass"></i> Search
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-2">
                            <form action="{{ route('payments.index') }}">
                                <input type="hidden" name="type" value="{{ request()->input('type')??'all' }}">
                                <div class="input-group mb-3">
                                    <button class="btn btn-primary">
                                        <i class="fa-solid fa-arrows-rotate"></i> Reset
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            {{-- Nav Tabs --}}
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link @if ($type=='all') active @endif" aria-current="page" href="{{ route('payments.index',['type'=>'all']) }}">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if ($type=='cash') active @endif" href="{{ route('payments.index',['type'=>'cash']) }}">Cash</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if ($type=='transfer') active @endif" href="{{ route('payments.index',['type'=>'transfer']) }}">Transfer</a>
                </li>
            </ul>


            @if (count($payments) == 0)
            <x-data-not-found></x-data-not-found>
            @else
            {{-- Table Data Payments --}}
            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead>
                        <th>No</th>
                        <th>Invoice Code</th>
                        <th>Payment Code</th>
                        <th>Paid Amount</th>
                        <th>Payment Type</th>
                        <th>Customer</th>
                        <th>Admin</th>
                        <th>Payment Date Time</th>
                    </thead>
                    <tbody>
                        @foreach ($payments as $key => $payment)
                        <tr>
                            <td>{{ $payments->firstItem()+$key }}</td>
                            <td>{{ $payment->invoice->code??"-" }}</td>
                            <td>{{ $payment->code }}</td>
                            <td>{{ formatToRupiah($payment->paid_amount) }}</td>
                            <td>
                                @if ($payment->payment_type == "cash")
                                <span class="badge rounded-pill bg-success">{{ ucfirst($payment->payment_type) }}</span>
                                @else
                                <span class="badge rounded-pill bg-primary">{{ ucfirst($payment->payment_type) }}</span>
                                @endif
                            </td>
                            <td>{{ $payment->invoice->customer->name??"-" }}</td>
                            <td>{{ $payment->user->name??"-" }}</td>
                            <td>{{ $payment->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $payments->links() }}
            </div>
            @endif
        </div>
    </div>




</x-dashboard.layout>
