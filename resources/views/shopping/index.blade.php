<x-dashboard.layout title="{{ $title }}" description="{{ $description }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="row">
        <div class="col-xl-7 col-xxl-8 mb-4">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <i class="fa-solid fa-cart-shopping"></i>
                    {{ $cardTitle }}
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-4">
                        <table class="table align-middle" id="table-product">
                            <thead>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Roll Quantity</th>
                                <th>Unit Per Roll</th>
                                <th>Unit Quantity</th>
                                <th>Unit Price</th>
                                <th>Sub Total</th>
                                <th class="text-center action-roll-header">Action</th>
                                <th>Available Roll</th>
                                <th>Available Unit</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <br>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary d-none" id="btn-summary-payment" data-bs-toggle="modal" data-bs-target="#summary-payment-modal">
                            Summary Payment
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="summary-payment-modal" tabindex="-1" aria-labelledby="summary-payment-modalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="summary-payment-modalLabel">Summary Payment</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive" id="summary-payment-container">
                                        </div>
                                        <br>
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label for="total-bill" class="form-label">Total Bill</label>
                                                <input type="text" class="form-control" id="total-bill" value="0" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="paid-amount" class="form-label">Paid Amount</label>
                                                <input type="text" class="form-control" id="paid-amount" value="0">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="payment-type" class="form-label">Payment Type</label>
                                                <select id="payment-type" class="form-select">
                                                    <option value="cash">Cash</option>
                                                    <option value="transfer">Transfer</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="row g-3 mt-4">
                                            <div class="col-md-12 mb-4">
                                                <input type="checkbox" class="btn-check" id="is-with-customer" autocomplete="off">
                                                <label class="btn btn-outline-primary" for="is-with-customer">Choose Customer</label>
                                            </div>
                                        </div>
                                        <div class="row g-3 d-none" id="customer-container-modal">
                                            <div class="col-md-12">
                                                <label for="select-customer" class="form-label">Customer</label>
                                                <select id="select-customer" class="form-select">
                                                    <option value="" selected disabled>-- Select customer --</option>
                                                    @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}" data-json="{{ json_encode($customer) }}">{{ $customer->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="id_number" class="form-label">ID Number</label>
                                                <input type="number" class="form-control" id="id_number" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="address" class="form-label">Address</label>
                                                <input type="text" class="form-control" id="address" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" class="form-control" id="phone" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="btn-confirm-shopping">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-5 col-xxl-4">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <i class="fa-solid fa-cart-shopping"></i>
                    {{ $cardTitle }}
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <label for="select-roll" class="form-label">Choose Roll</label>
                        <select id="select-roll" name="roll">
                            @foreach ($rolls as $key => $roll)
                            <option value="{{ $roll->id }}" data-data="{{ json_encode($roll) }}">
                                {{ $roll->id }} | {{ $roll->name }} | {{ $roll->qrcode }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section("custom-scripts")
    <script src="{{ asset('js/shopping/index.js') }}"></script>
    @endsection
</x-dashboard.layout>
