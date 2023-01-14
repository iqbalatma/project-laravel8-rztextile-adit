<x-dashboard.layout title="{{ $title }}" description="{{ $description }}">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-users-gear"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            <form class="row g-3" method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="col-md-12">
                    <label for="id_number" class="form-label">ID Number</label>
                    <input type="text" class="form-control" id="id_number" name="id_number" placeholder="Enter id number of new user" required value="{{old('id_number')}}">
                </div>
                <div class="col-md-12">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name of new user" required value="{{old('name')}}">
                </div>
                <div class="col-md-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email of new user" required value="{{old('email')}}">
                </div>
                <div class="col-md-12">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="col-md-12">
                    <label for="password_confirmation" class="form-label">Password Confirmation</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>
                <div class="col-md-12">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="phone" class="form-control" id="phone" name="phone" placeholder="Enter phone of new user" required value="{{old('phone')}}">
                </div>
                <div class="col-md-12">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter your address">{{old('address')}}</textarea>
                </div>
                <div class="col-md-12">
                    <label for="role_id" class="form-label">Roles</label>
                    <select class="form-select" aria-label="Default select example" name="role_id">
                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <a href="{{ route('users.index') }}" class="btn btn-danger"><i class="fa-solid fa-square-xmark"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard.layout>
