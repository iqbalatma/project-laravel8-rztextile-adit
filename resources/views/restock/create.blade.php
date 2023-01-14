<x-dashboard.layout title="{{ $title }}" description="{{ $description }}">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-truck-ramp-box"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            <form class="row g-3" method="POST" action="{{ route('restock.store') }}">
                @csrf
                <div class="col-md-12">
                    <label for="roll" class="form-label">Select Roll For Restock</label>
                    <select class="form-select" aria-label="Select unit for roll" name="roll_id" id="roll">
                        <option selected disabled>Select Roll Below</option>
                        @foreach ($rolls as $roll)
                        <option value="{{ $roll->id }}">{{ $roll->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="quantity_roll" class="form-label">Quantity Roll Transaction</label>
                    <input type="number" min="0" class="form-control" id="quantity_roll" name="quantity_roll" placeholder="Enter quantity roll" required>
                </div>
                <div class="col-md-12">
                    <label for="quantity_unit" class="form-label">Quantity Unit Transaction</label>
                    <input type="number" min="0" class="form-control" id="quantity_unit" name="quantity_unit" placeholder="Enter quantity unit" required>
                </div>
                <div class="col-12">
                    <a href="{{ route('roll.transactions.index') }}" class="btn btn-danger"><i class="fa-solid fa-square-xmark"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard.layout>
