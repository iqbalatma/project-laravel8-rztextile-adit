<x-dashboard.layout title="{{ $title }}" description="{{ $description }}">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-code"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            <form class="row g-3" method="POST" action="{{ route('registration.credentials.store') }}">
                @csrf
                <div class="col-md-12">
                    <label for="credential" class="form-label">Credentials</label>
                    <input type="text" class="form-control" id="credential" name="credential" value="{{ $credential }}" readonly>
                </div>
                <div class="col-md-12">
                    <label for="role_id" class="form-label">Select Role Credential</label>
                    <select class="form-select" aria-label="Select payment type for payment" name="role_id" id="role_id">
                        <option selected disabled>Select Role Below</option>
                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <a href="{{ route('registration.credentials.index') }}" class="btn btn-danger"><i class="fa-solid fa-square-xmark"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                </div>
            </form>
        </div>
    </div>

    @section("custom-scripts")
    <script src="{{ asset('js/payments/create.js') }}"></script>
    @endsection
</x-dashboard.layout>
