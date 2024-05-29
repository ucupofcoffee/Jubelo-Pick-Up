@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12">
                <div class="table-responsive bg-white rounded shadow py-1">
                    <div class="row my-4 d-flex justify-content-between">
                        <div class="col-6">
                            <h1 class="mx-4">Driver</h1>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('driver.create') }}" class="btn btn-primary mx-4">+ Add Driver</a>
                        </div>
                    </div>
                    <table class="table align-items-center">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="col-3">Name</th>
                                <th scope="col" class="col-2">Email</th>
                                <th scope="col" class="col-2">Number</th>
                                <th scope="col" class="col-4 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($drivers as $driver)
                                <tr>
                                    <td class="">{{ $driver->name }}</td>
                                    <td class="">{{ $driver->email }}</td>
                                    <td class="">{{ $driver->phone }}</td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
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
