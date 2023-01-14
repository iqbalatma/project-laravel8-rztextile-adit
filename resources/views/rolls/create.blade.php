<x-dashboard.layout title="{{ $title }}" description="{{ $description }}">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-boxes-stacked"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            <form class="row g-3" method="POST" action="{{ route('rolls.store') }}">
                @csrf
                <div class="col-md-12">
                    <label for="name" class="form-label">Roll Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name of new roll" required>
                </div>
                <div class="col-md-12">
                    <label for="code" class="form-label">Roll Code</label>
                    <input type="text" class="form-control" id="code" name="code" placeholder="Roll code will generate automatically !" readonly required>
                </div>
                <div class="col-md-12">
                    <label for="quantity_roll" class="form-label">Quantity Roll</label>
                    <input type="number" min="0" class="form-control" id="quantity_roll" name="quantity_roll" placeholder="Enter quantity roll" required>
                </div>
                <div class="col-md-12">
                    <label for="quantity_unit" class="form-label">Quantity Unit</label>
                    <input type="number" min="0" class="form-control" id="quantity_unit" name="quantity_unit" placeholder="Enter quantity unit" required>
                </div>
                <div class="col-md-12">
                    <label for="basic_price" class="form-label">Basic Price</label>
                    <input type="number" min="0" class="form-control" id="basic_price" name="basic_price" placeholder="Enter basic price of each unit roll" required>
                </div>
                <div class="col-md-12">
                    <label for="selling_price" class="form-label">Selling Price</label>
                    <input type="number" min="0" class="form-control" id="selling_price" name="selling_price" placeholder="Enter selling price of each unit roll" required>
                </div>
                <div class="col-md-12">
                    <label for="unit" class="form-label">Select Unit For Roll</label>
                    <select class="form-select" aria-label="Select unit for roll" name="unit_id" id="unit">
                        <option selected disabled>Select Unit Below</option>
                        @foreach ($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12">
                    <a href="{{ route('rolls.index') }}" class="btn btn-danger"><i class="fa-solid fa-square-xmark"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>

    @section("custom-scripts")
    <script src="{{ asset('js/rolls/create.js') }}"></script>
    @endsection
</x-dashboard.layout>
