<x-dashboard.layout title="{{ $title }}" description="{{ $description }}">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-file-invoice-dollar"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4">
                <a href="{{ route('registration.credentials.create') }}" type="button" class="btn btn-primary">
                    <i class="fa-solid fa-square-plus"></i>
                    Add New Credentials</a>
            </div>



            @if ($registrationCredentials->count() == 0)
            <x-data-not-found></x-data-not-found>
            @else
            {{-- Data Table Credentials --}}
            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead>
                        <th>No</th>
                        <th>Credentials</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($registrationCredentials as $key => $credential)
                        <tr>
                            <td>{{ $registrationCredentials->firstItem()+$key }}</td>
                            <td>{{ $credential->credential }}</td>
                            <td>{{ $credential->role->name ?? "-" }}</td>
                            <td>
                                @if ($credential->is_active)
                                <span class="badge rounded-pill bg-success">Active</span>
                                @else
                                <span class="badge rounded-pill bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-grid gap-2 d-md-flex">
                                    <form action="{{ route('registration.credentials.update', $credential->id) }}" method="POST">
                                        @csrf
                                        @method("PUT")
                                        @if ($credential->is_active)
                                        <input type="hidden" value="0" name="is_active">
                                        <button type="submit" class="btn btn-warning">Inactive</button>
                                        @else
                                        <input type="hidden" value="1" name="is_active">
                                        <button type="submit" class="btn btn-primary">Activate</button>
                                        @endif
                                    </form>
                                    <form action="{{ route('registration.credentials.destroy', $credential->id) }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

        </div>
    </div>

</x-dashboard.layout>
