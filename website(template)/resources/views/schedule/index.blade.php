@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12">
                <div class="table-responsive bg-white rounded shadow p-3">
                    <div class="h4">{{ $today }}</div>
                    @if ($schedule->isNotEmpty())

                        @if ($pickup1->isNotEmpty())
                            <div class="col mt-4" style="width: 100%; display: flex;">
                                <div class="shadow p-3"
                                    style="width: 5%; border-top-left-radius: 10px; border-bottom-left-radius: 10px; background-color: #2236A8">
                                </div>
                                <div style="width: 100%;">
                                    <div class="shadow p-3"
                                        style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                        @foreach ($pickup1 as $pickup)
                                            <a href="{{ route('schedule.detail', ['id' => $pickup->scheduleid]) }}"
                                                style="text-decoration: none; color: inherit;">
                                                <h3>{{ $pickup->name }}</h3>
                                                <h5><i class="ni ni-square-pin text-blue"></i> {{ $pickup->full_address }}
                                                </h5>
                                                <h5><i class="ni ni-basket text-blue"></i>
                                                    {{ $pickup->type ? $pickup->type->name : '-' }}</h5>
                                                <h5><i class="ni ni-time-alarm text-blue"></i> {{ $pickup->pick_up_time }}
                                                </h5>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($pickup2->isNotEmpty())
                            <div class="col mt-4" style="width: 100%; display: flex;">
                                <div class="shadow p-3"
                                    style="width: 5%; border-top-left-radius: 10px; border-bottom-left-radius: 10px; background-color: #2236A8">
                                </div>
                                <div style="width: 100%;">
                                    <div class="shadow p-3"
                                        style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                        @foreach ($pickup2 as $pickup)
                                            <a href="{{ route('schedule.detail', ['id' => $pickup->scheduleid]) }}"
                                                style="text-decoration: none; color: inherit;">
                                                <h3>{{ $pickup->name }}</h3>
                                                <h5><i class="ni ni-square-pin text-blue"></i> {{ $pickup->full_address }}
                                                </h5>
                                                <h5><i class="ni ni-basket text-blue"></i>
                                                    {{ $pickup->type ? $pickup->type->name : '-' }}</h5>
                                                <h5><i class="ni ni-time-alarm text-blue"></i> {{ $pickup->pick_up_time }}
                                                </h5>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($pickup3->isNotEmpty())
                            <div class="col mt-4" style="width: 100%; display: flex;">
                                <div class="shadow p-3"
                                    style="width: 5%; border-top-left-radius: 10px; border-bottom-left-radius: 10px; background-color: #2236A8">
                                </div>
                                <div style="width: 100%;">
                                    <div class="shadow p-3"
                                        style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                        @foreach ($pickup3 as $pickup)
                                            <a href="{{ route('schedule.detail', ['id' => $pickup->scheduleid]) }}"
                                                style="text-decoration: none; color: inherit;">
                                                <h3>{{ $pickup->name }}</h3>
                                                <h5><i class="ni ni-square-pin text-blue"></i> {{ $pickup->full_address }}
                                                </h5>
                                                <h5><i class="ni ni-basket text-blue"></i>
                                                    {{ $pickup->type ? $pickup->type->name : '-' }}</h5>
                                                <h5><i class="ni ni-time-alarm text-blue"></i> {{ $pickup->pick_up_time }}
                                                </h5>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="text-center my-5">
                            <h1>No schedule for today</h1>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
