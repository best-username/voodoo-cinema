function getAvailabilities() {
    $.ajax({
        url: window.location.protocol + '//' + window.location.host + '/api/getAllDates',
        success: function (response) {
            $('#date').empty();
            $('#time').empty();
            $.each(response.data.dates, function (index, element) {
                $('#date').append("<option value='" + index + "'>" + element + "</option>");
            });
            $.each(response.data.times, function (index, element) {
                $('#time').append("<option value='" + index + "'>" + element + "</option>");
            });
        },
        error: function (error) {
        }
    });
}

$(document).ready(function () {
    getAvailabilities();
});



function saveBooking() {

    let form = document.getElementById('saveBookingForm');

    $.ajax({
        url: window.location.protocol + '//' + window.location.host + '/api/saveBooking',
        type: "POST",
        data: new FormData(form),
        contentType: false,
        processData: false,
        cache: false,
        success: function (response) {
            console.log(response);
            checkAvailability();
        },
        error: function (response) {
//            console.log(response);
        }
    });
}


function checkAvailability() {

    let date = $('#date').val();
    let time = $('#time').val();

    $.ajax({
        url: window.location.protocol + '//' + window.location.host + '/api/checkAvailability/' + date + '/' + time,
        success: function (response) {
            $('#seat_number').empty();
            $('#seat_button').empty();

            for (let i = 1; i <= response.data.seats; i++) {
                let disabled = '';
                let checked = '';

                let x = new Date();
                let dateString = response.data.start_date + ' ' + response.data.time + ':00';

                var reggie = /(\d{2})-(\d{2})-(\d{4}) (\d{2}):(\d{2}):(\d{2})/;
                var dateArray = reggie.exec(dateString);
                var y = new Date(
                        (+dateArray[3]),
                        (+dateArray[2]) - 1, // Careful, month starts at 0!
                        (+dateArray[1]),
                        (+dateArray[4]),
                        (+dateArray[5]),
                        (+dateArray[6])
                        );

                if (x > y) {
                    disabled = 'disabled';

                }
                if (response.data.bookings.includes(i)) {
                    disabled = 'disabled';
                    checked = 'checked';
                }

                $('#seat_number').append("<input type='checkbox' name='seat_number[]' " + disabled + " " + checked + " id='" + i + "'  value='" + i + "'> <label for='" + i + "'> " + i + "</label>");

                if (i % 5 == 0) {
                    $('#seat_number').append("<br>");
                }
            }

            let a = $('#seat_button').append("<input type='hidden' name='availability_id' id='availability_id' value='" + response.data.id + "'>");

            var saveBookingForm = document.getElementById('saveBookingForm');
            if (saveBookingForm.style.display === 'none') {
                saveBookingForm.style.display = 'block';
            }

            $(document).on('click', '#saveBooking', function () {
                saveBooking();
            });

        },
        error: function (error) {
        }
    });
}