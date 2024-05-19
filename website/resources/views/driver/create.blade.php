@extends('layouts.app')

@section('content')
    <div class="pickup-container">
        <div class="row">
            <div class="card">
                <form action="{{ route('driver.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h3>Create Driver</h3>
                    </div>
                    <div class="card-body card-crud">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label-create">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="Type driver name" required
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label-create">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="Type driver email" required
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label-create">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Type driver password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label-create">Phone</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" placeholder="Type driver phone" required
                                        value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <div class="d-flex justify-content-start">
                        <a href="{{ route('driver.index') }}" class="btn-pickup btn-create-back">Back</a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn-pickup btn-create-submit">Submit</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
