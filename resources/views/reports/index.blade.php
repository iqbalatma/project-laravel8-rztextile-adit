<x-dashboard.layout title="{{ $title }}" description="{{ $description }}">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-file-lines"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            <form class="row g-3" method="POST" action="{{ route('reports.download') }}">
                @csrf
                <div class="col-6">
                    <div class="row g-3">
                        <div class="col-md-12">
                            {{-- <label for="selectPeriod" class="form-label">Period</label>
              <select id="selectPeriod" class="form-select">
                <option selected disabled>Choose Period Below</option>
                <option value="daily">Daily</option>
                <option value="monthly">Monthly</option>
                <option value="yearly">Yearly</option>
                <option value="custom">Custom</option>
                <option value="custom-monthly">Custom Monthly</option>
                <option value="custom-yearly">Custom Yearly</option>
              </select> --}}

                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="startDate" class="form-label">Start Date</label>
                                    <input type="text" class="form-control" id="startDate" required name="start_date" autocomplete="off" autofill="off">
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="startDate" class="form-label">End Date</label>
                                    <input type="text" class="form-control" id="endDate" required name="end_date" autocomplete="off" autofill="off">
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-12 mx-2">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="sales-report" name="sales_report">
                <label class="form-check-label" for="sales-report">Sales Report</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="warehouse-report" name="warehouse_report">
                <label class="form-check-label" for="warehouse-report">Warehouse Report</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="payment-report" name="payment_report">
                <label class="form-check-label" for="payment-report">Payment Report</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="customer-report" name="customer_report">
                <label class="form-check-label" for="customer-report">Customer Report</label>
              </div>
            </div> --}}


                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-download"></i> Download Report
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-6">

                    {{-- <div class="row d-none datepicker-row" id="row-date-daily">
            <div class="mb-3 col-12">
              <label for="startDate" class="form-label">Date</label>
              <input type="text" class="form-control" id="date-daily">
            </div>
          </div> --}}


                    {{-- <div class="row d-none datepicker-row" id="row-date-monthly">
            <div class="mb-3 col-12">
              <label for="startDate" class="form-label">Month</label>
              <input type="text" class="form-control" id="startDate">
            </div>
          </div>


          <div class="row d-none datepicker-row" id="row-date-yearly">
            <div class="mb-3 col-12">
              <label for="startDate" class="form-label">Year</label>
              <input type="text" class="form-control" id="startDate">
            </div>
          </div> --}}


                    {{-- <div class="row d-none datepicker-row" id="row-date-custom">
            <div class="mb-3 col-6">
              <label for="startDate" class="form-label">Start Date</label>
              <input type="text" class="form-control" id="startDate">
            </div>
            <div class="mb-3 col-6">
              <label for="startDate" class="form-label">End Date</label>
              <input type="text" class="form-control" id="startDate">
            </div>
          </div> --}}

                    {{-- <div class="row d-none datepicker-row" id="row-date-custom-monthly">
            <div class="mb-3 col-6">
              <label for="startDate" class="form-label">Start Month</label>
              <input type="text" class="form-control" id="startDate">
            </div>
            <div class="mb-3 col-6">
              <label for="startDate" class="form-label">End Month</label>
              <input type="text" class="form-control" id="startDate">
            </div>
          </div> --}}

                    {{-- <div class="row d-none datepicker-row" id="row-date-custom-yearly">
            <div class="mb-3 col-6">
              <label for="startDate" class="form-label">Start Year</label>
              <input type="text" class="form-control" id="custom-yearly-start-year">
            </div>
            <div class="mb-3 col-6">
              <label for="startDate" class="form-label">End Year</label>
              <input type="text" class="form-control" id="custom-yearly-end-year">
            </div>
          </div> --}}

                </div>
            </form>
        </div>
    </div>


    @section("custom-scripts")
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="{{ asset('js/reports/index.js') }}"></script>
    @endsection
</x-dashboard.layout>
