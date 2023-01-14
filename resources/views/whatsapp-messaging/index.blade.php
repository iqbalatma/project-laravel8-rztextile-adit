<x-dashboard.layout title="{{ $title }}" description="{{ $description }}">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-comments"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form method="POST" action="{{ route('whatsapp.messaging.store') }}">
                    @csrf
                    <div class="mb-3">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                Select Customer
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                @foreach ($customers as $key => $customer)
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="customer[]" value="{{ $customer->id }}" id="customer-{{ $customer->id }}" />
                                            <label class="form-check-label" for="customer-{{ $customer->id }}">{{ $customer->phone }} | {{ $customer->name }} </label>
                                        </div>
                                    </a>
                                </li>
                                @endforeach



                                <li>
                                    <hr class="dropdown-divider">
                                </li>


                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="select-all" />
                                            <label class="form-check-label" for="select-all">Select All</label>
                                        </div>
                                    </a>
                                </li>


                            </ul>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="promotion" class="form-label">Promotion Message Name</label>
                        <select class="form-select" id="promotion" aria-label="Default select example">
                            <option selected disabled>Open this select menu</option>
                            @foreach ($promotionMessages as $promotion)
                            <option value="{{ $promotion->id }}">{{ $promotion->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <div class="card">
                            <div class="card-body">
                                <input type="hidden" name="message" id="message-input">
                                <div id="message"></div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa-sharp fa-solid fa-paper-plane"></i> Send</button>
                </form>
            </div>
        </div>
    </div>


    @section("custom-scripts")
    <script src="{{ asset('js/whatsapp-messaging/index.js') }}"></script>
    @endsection

</x-dashboard.layout>
