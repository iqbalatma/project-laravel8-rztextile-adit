<x-dashboard.layout title="{{ $title }}" description="{{ $description }}">
    <div class=" card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-users-between-lines"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            <form class="row g-3" method="POST" action="{{ route('customers.store') }}">
                @csrf
                <div class="col-md-12">
                    <label for="id_number" class="form-label">ID Number</label>
                    <input type="number" class="form-control" id="id_number" name="id_number" placeholder="Enter id number of new customer" required>
                </div>
                <div class="col-md-12">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name of new customer" required>
                </div>
                <div class="col-md-12">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number of new customer" required>
                </div>
                <div class="col-md-12">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                </div>
                <div class="col-12">
                    <a href="{{ route('customers.index') }}" class="btn btn-danger"><i class="fa-solid fa-square-xmark"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard.layout>
