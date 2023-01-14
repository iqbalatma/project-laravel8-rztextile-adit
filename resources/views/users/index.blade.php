<x-dashboard.layout title="{{ $title }}" description="{{ $description }}">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-users-gear"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            {{-- Button Add New User --}}
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <a href="{{ route('users.create') }}" type="button" class="btn btn-primary">
                    <i class="fa-solid fa-square-plus"></i>
                    Add New User</a>
            </div>



            @if ($users->count()==0)
            <x-data-not-found></x-data-not-found>
            @else
            {{-- Table Users --}}
            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead>
                        <th>No</th>
                        <th>ID Number</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Email Verified At</th>
                        <th>Last Updated Time</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                        <tr>
                            <td>{{ $users->firstItem()+$key }}</td>
                            <td>{{ $user->id_number??"-" }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                <span class="badge rounded-pill
                @if ($user->role->id==1)
                bg-danger
                @elseif($user->role->id==2)
                bg-warning
                @elseif($user->role->id==3)
                bg-success
                @else
                bg-primary
                @endif
               ">{{ ucfirst($user->role->name) }}</span>
                            </td>
                            <td>
                                @if ($user->is_active)
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                @if (!$user->email_verified_at)
                                <span class="badge bg-warning">Not Verified</span>
                                @else
                                {{ $user->email_verified_at }}
                                @endif
                            </td>
                            <td>{{ $user->updated_at }}</td>
                            <td>
                                <div class="d-grid gap-2 d-md-flex">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-success">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('users.suspend', $user->id) }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-sm btn-warning btn-delete">
                                            <i class="fa-solid fa-x"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
            @endif
        </div>
    </div>

    @section("custom-scripts")
    <script src="{{ asset('js/user-managements/index.js') }}"></script>
    @endsection

</x-dashboard.layout>
