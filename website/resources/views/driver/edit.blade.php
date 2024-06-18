@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12">
                <div class="table-responsive bg-white rounded shadow py-1">
                    <form action="{{ route('driver.update', ['id' => $driver->driverid]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row my-4 d-flex justify-content-between">
                            <div class="col-6">
                                <h1 class="mx-4">Edit Driver</h1>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('driver.index') }}" class="btn btn-secondary">Cancel</a>
                                <button class="btn btn-primary mx-4" type="submit">Submit</button>
                            </div>
                        </div>
                        <div class="card-body card-crud">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label-create">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name', $driver->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label-create">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email', $driver->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="day" class="form-label-create">Work Day</label>
                                        <select class="form-control @error('day') is-invalid @enderror" id="day" name="day" required>
                                            <option value="" disabled {{ old('day', $driver->day) ? '' : 'selected' }}>Select a day</option>
                                            <option value="Monday" {{ old('day', $driver->day) == 'Monday' ? 'selected' : '' }}>Monday</option>
                                            <option value="Tuesday" {{ old('day', $driver->day) == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                                            <option value="Wednesday" {{ old('day', $driver->day) == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                                            <option value="Thursday" {{ old('day', $driver->day) == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                                            <option value="Friday" {{ old('day', $driver->day) == 'Friday' ? 'selected' : '' }}>Friday</option>
                                            <option value="Saturday" {{ old('day', $driver->day) == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                                            <option value="Sunday" {{ old('day', $driver->day) == 'Sunday' ? 'selected' : '' }}>Sunday</option>
                                        </select>
                                        @error('day')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password" class="form-label-create">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" placeholder="Leave blank to keep the same password">
                                        @error('password')
                                            <div class="invalid-feedback error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label-create">Phone</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" name="phone" value="{{ old('phone', $driver->phone) }}" required>
                                        @error('phone')
                                            <div class="invalid-feedback error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label-create">Status</label>
                                        <input type="text" class="form-control" id="status" name="status" value="Active" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
