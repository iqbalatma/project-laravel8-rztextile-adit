<x-dashboard.layout title="{{ $title }}" description="{{ $description }}">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-right-left"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4">
                <a href="{{ route('roll.transactions.putAway') }}" type="button" class="btn btn-danger">
                    <i class="fa-solid fa-square-minus"></i>
                    Put Away
                </a>
                <a href="{{ route('restock.create') }}" type="button" class="btn btn-primary">
                    <i class="fa-solid fa-square-plus"></i>
                    Restock
                </a>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <form action="{{ route('roll.transactions.index') }}">
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
                            <form action="{{ route('roll.transactions.index') }}">
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
                            <form action="{{ route('roll.transactions.index') }}">
                                <input type="hidden" name="type" value="{{ request()->input('type', 'all') }}">
                                <button class="btn btn-primary">Reset</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link @if ($type=='all') active @endif" aria-current="page" href="{{ route('roll.transactions.index',['type'=>'all']) }}">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if ($type=='restock') active @endif" href="{{ route('roll.transactions.index',['type'=>'restock']) }}">Restock</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if ($type=='sold') active @endif" href="{{ route('roll.transactions.index',['type'=>'sold']) }}">Sold</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if ($type=='broken') active @endif" href="{{ route('roll.transactions.index',['type'=>'broken']) }}">Broken</a>
                </li>
            </ul>


            @if ($rollTransactions->count() == 0)
            <x-data-not-found></x-data-not-found>
            @else
            {{-- Data Table Roll Transaction --}}
            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead>
                        <th>No</th>
                        <th>Invoice Code</th>
                        <th>Roll Name</th>
                        <th>Roll Code</th>
                        <th>Quantity Roll</th>
                        <th>Quantity Unit</th>
                        <th>Type</th>
                        <th>Admin</th>
                        <th>Date Time</th>
                    </thead>
                    <tbody>
                        @foreach ($rollTransactions as $key => $transaction)
                        <tr>
                            <td>{{ $rollTransactions->firstItem()+$key }}</td>
                            <td>{{ $transaction->invoice->code??"-" }}</td>
                            <td>{{ $transaction->roll->name??"-" }}</td>
                            <td>{{ $transaction->roll->code??"-" }}</td>
                            <td>{{ $transaction->quantity_roll??0 }}</td>
                            <td>{{ ($transaction->quantity_unit??0) . " " . ($transaction->roll->unit->name ??"") }}</td>
                            <td>
                                @if ($transaction->type=="restock")
                                <span class="badge rounded-pill bg-success">{{ $transaction->type }}</span>
                                @elseif ($transaction->type=="sold")
                                <span class="badge rounded-pill bg-primary">{{ $transaction->type }}</span>
                                @else
                                <span class="badge rounded-pill bg-danger">{{ $transaction->type }}</span>
                                @endif
                            </td>
                            <td>{{ $transaction->user->name??"-" }}</td>
                            <td>{{ $transaction->created_at??"-" }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $rollTransactions->links() }}

            </div>
            @endif
        </div>
    </div>
</x-dashboard.layout>
