<x-dashboard.layout title="{{ $title }}" description="{{ $description }}">
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    Invoices {{ $currentMonth }}
                    <br>
                    {{ $total_invoices }}
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('report.invoices.index') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    Capital {{ $currentMonth }}
                    <br>
                    {{ $total_capital }}
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('report.invoices.index') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    Profit {{ $currentMonth }}
                    <br>
                    {{ $total_profit }}
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('report.invoices.index') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    Total Customer
                    <br>
                    {{ $total_customer }} customers
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('report.invoices.index') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Segmentation Customer
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Segmentation Name</th>
                                <th scope="col">Total Customer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Most Valueable Customer</td>
                                <td>{{ isset($dataRFM["customers"]["m"]) ? count($dataRFM["customers"]["mvc"]):0 }} customers</td>
                            </tr>
                            <tr>
                                <td>Most Growable Customer</td>
                                <td>{{ isset($dataRFM["customers"]["mgc"]) ?count($dataRFM["customers"]["mgc"]):0 }} customers</td>
                            </tr>
                            <tr>
                                <td>Migration Customer</td>
                                <td>{{ isset($dataRFM["customers"]["m"]) ? count($dataRFM["customers"]["m"]):0 }} customers</td>
                            </tr>
                            <tr>
                                <td>Bellow Zero Customer</td>
                                <td>{{ isset($dataRFM["customers"]["bz"]) ? count($dataRFM["customers"]["bz"]):0 }} customers</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Sales Summary
                </div>
                <div class="card-body">
                    <canvas id="salesChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    Latest Invoices
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-4">
                        <table class="table align-middle">
                            <thead>
                                <th>No</th>
                                <th>Code</th>
                                <th>Customer</th>
                                <th>Capital</th>
                                <th>Profit</th>
                            </thead>
                            <tbody>
                                @foreach ($latestInvoices as $key => $invoice)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $invoice->code }}</td>
                                    <td>{{ $invoice->customer->name??"-" }}</td>
                                    <td>{{ formatToRupiah($invoice->total_capital) }}</td>
                                    <td>{{ formatToRupiah($invoice->total_profit) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa-solid fa-boxes-stacked"></i>
                    Least Rolls
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-4">
                        <table class="table align-middle">
                            <thead>
                                <th>No</th>
                                <th>Code</th>
                                <th>Roll Name</th>
                                <th>Quantity Roll</th>
                                <th>Quantity Unit</th>
                                <th>Selling Price</th>
                            </thead>
                            <tbody>
                                @foreach ($leastRolls as $key => $roll)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $roll->code }}</td>
                                    <td>{{ $roll->name }}</td>
                                    <td>{{ $roll->quantity_roll }}</td>
                                    <td>{{ $roll->quantity_unit . " " . ($roll->unit->name ?? "") }}</td>
                                    <td>{{ formatToRupiah($roll->selling_price) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @section("custom-scripts")
    <script src="{{ asset('js/dashboard/index.js') }}"></script>
    @endsection
</x-dashboard.layout>
