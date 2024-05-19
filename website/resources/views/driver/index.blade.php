@extends('layouts.app')

@section('content')
    <div class="pickup-container">
        <div class="row">
            <div class="col-6">
                <form action="{{ route('driver.search') }}" method="GET">
                    <div class="input-group">
                        <span class="input-group-search" id="search-addon">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="search" class="form-control-search" placeholder="Search here..." aria-label="Search"
                            aria-describedby="search-addon" name="search" />
                    </div>
                </form>
            </div>
            <div class="col-6 text-end">
                <div class="button">
                    <a href="{{ route('driver.create') }}" class="btn btn-pickup btn-create">+ New Driver</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th class="text-center th-name">Name</th>
                                <th class="text-center th-email">Email</th>
                                <th class="text-center th-phone">Phone</th>
                                <th class="text-center th-action">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($drivers as $driver)
                                <tr>
                                    <td class="text-center td-name">{{ $driver->name }}</td>
                                    <td class="text-center td-email">{{ $driver->email }}</td>
                                    <td class="text-center td-phone">{{ $driver->phone }}</td>
                                    <td class="text-center td-action">
                                        <div class="dropdown">
                                            <button class="btn-dots" type="button" id="actionDropdown"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="actionDropdown">
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('driver.edit', ['id' => $driver->driverid]) }}">Edit</a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('driver.delete', ['id' => $driver->driverid]) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Are you sure you want to delete this data?')">Delete</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
