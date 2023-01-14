<x-dashboard.layout title="{{ $title }}" description="{{ $description }}">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-magnifying-glass"></i>
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

    <div class="card mb-4">
        <div class="card-header">
            Result
        </div>
        <div class="card-body">
            <table class="table table-borderless" id="result-searched-roll">
                <tbody>
                    <tr>
                        <th scope="row">Name</th>
                        <th scope="row">:</th>
                        <th scope="row" id="roll-name"></th>
                    </tr>
                    <tr>
                        <th scope="row">Code</th>
                        <th scope="row">:</th>
                        <th scope="row" id="roll-code"></th>
                    </tr>
                    <tr>
                        <th scope="row">Quantity Roll</th>
                        <th scope="row">:</th>
                        <th scope="row" id="roll-quantity-roll"></th>
                    </tr>
                    <tr>
                        <th scope="row">Quantity Unit</th>
                        <th scope="row">:</th>
                        <th scope="row" id="roll-quantity-unit"></th>
                    </tr>
                    <tr>
                        <th scope="row">QR Code</th>
                        <th scope="row">:</th>
                        <th scope="row" id="roll-qrcode"></th>
                    </tr>
                    <tr>
                        <th scope="row">Basic Price</th>
                        <th scope="row">:</th>
                        <th scope="row" id="roll-basic-price"></th>
                    </tr>
                    <tr>
                        <th scope="row">Selling Price</th>
                        <th scope="row">:</th>
                        <th scope="row" id="roll-selling-price"></th>
                    </tr>
                    <tr>
                        <th scope="row">Last Update</th>
                        <th scope="row">:</th>
                        <th scope="row" id="roll-last-update"></th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    @section("custom-scripts")
    <script src="{{ asset('js/search-roll/index.js') }}"></script>
    @endsection
</x-dashboard.layout>
