@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12">
                <div class="table-responsive bg-white rounded shadow p-3">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 id="eventDate"></h3>
                    <ul id="transactionList"></ul>
                    <button id="detailButton" class="btn btn-primary" style="display: none;">Detail</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var eventModal = new bootstrap.Modal(document.getElementById('eventModal'));
            var detailButton = document.getElementById('detailButton');
            var currentEventData = [];

            var calendar = new FullCalendar.Calendar(calendarEl, {
                aspectRatio: 1.5,
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev',
                    center: 'title',
                    right: 'today next'
                },
                events: "{{ route('history.list') }}",
                dateClick: function(info) {
                    var clickedDate = info.dateStr;
                    getEventDataForDate(clickedDate, function(eventData) {
                        currentEventData = eventData;
                        displayEventData(eventData);
                        eventModal.show();
                    });
                }
            });
            calendar.render();

            function getEventDataForDate(date, callback) {
                $.ajax({
                    url: "{{ route('history.list') }}",
                    type: "GET",
                    data: {
                        date: date
                    },
                    success: function(response) {
                        console.log('Response from server:', response);

                        var filteredTransactions = response.filter(function(transaction) {
                            var transactionDate = new Date(transaction.start).toISOString().slice(0, 10);
                            return transactionDate === date;
                        });

                        callback(filteredTransactions);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            function displayEventData(eventData) {
                var eventDateElement = document.getElementById('eventDate');
                var transactionListElement = document.getElementById('transactionList');

                transactionListElement.innerHTML = '';

                if (eventData.length > 0) {
                    var firstEvent = eventData[0];
                    var eventDate = firstEvent.start ? new Date(firstEvent.start) : firstEvent.end ? new Date(firstEvent.end) : null;

                    if (eventDate) {
                        eventDateElement.innerText = "Event Date: " + eventDate.toISOString().slice(0, 10);
                    } else {
                        eventDateElement.innerText = "Event Date: Unknown";
                    }

                    eventData.forEach(function(event) {
                        if (event.title) {
                            console.log('Transaction found:', event.title);
                            var transactionId = event.title;
                            var transactionItem = document.createElement('li');
                            var transactionLink = document.createElement('a');
                            transactionLink.innerText = transactionId;
                            transactionItem.appendChild(transactionLink);
                            transactionListElement.appendChild(transactionItem);
                        } else {
                            console.log('No transaction found in event:', event);
                        }
                    });

                    detailButton.style.display = 'block';
                } else {
                    eventDateElement.innerText = "Event Date: Unknown";
                    transactionListElement.innerHTML = '<p>No transactions found for this date.</p>';

                    detailButton.style.display = 'none';
                }

                $('#eventModal').modal('show');
            }

            detailButton.addEventListener('click', function() {
                if (currentEventData.length > 0) {
                    var pickUpDate = currentEventData[0].start;

                    window.location.href = "{{ route('history.detail', ['pick_up_date' => ':pick_up_date']) }}".replace(':pick_up_date', pickUpDate);
                }
            });
        });
    </script>
@endsection
