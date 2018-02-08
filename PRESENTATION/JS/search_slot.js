jQuery(document).ready(function ($) {
    var location = $('#parking_area_id').val();
    var vehicle_type = $('#vehicle_type').val();
    var date = $('#date').val();
    var start_time = $('#start_time').val();
    var end_time = $('#end_time').val();
    if (location != '' && vehicle_type != '' && date != '' && start_time != '' && end_time != '') {
        $('#slot-search-area').html('');
        var data = {date: date, location: location, vehicle_type: vehicle_type, start_time: start_time, end_time: end_time};
        getslot(base_url, data, '/PRESENTATION/PROCESS/ajax_common.php?request=search_slot');

    }
    $("#search-slot").click(function () {
        location = $('#parking_area_id').val();
        vehicle_type = $('#vehicle_type').val();
        date = $('#date').val();
        start_time = $('#start_time').val();
        end_time = $('#end_time').val();
        if (location != '' && vehicle_type != '' && date != '' && start_time != '' && end_time != '') {
            $('#slot-search-area').html('Searching !!!');
            var data = {date: date, location: location, vehicle_type: vehicle_type, start_time: start_time, end_time: end_time};
            getslot(base_url, data, '/PRESENTATION/PROCESS/ajax_common.php?request=search_slot');

        }
    });
    $(document).on('click', '.booking_button', function () {
        var slot_id = $(this).attr('id');
        location = $('#parking_area_id').val();
        vehicle_type = $('#vehicle_type').val();
        date = $('#date').val();
        start_time = $('#start_time').val();
        end_time = $('#end_time').val();
        data = {slot_id: slot_id, date: date, location: location, vehicle_type: vehicle_type, start_time: start_time, end_time: end_time};
        $.ajax({
            url: base_url +'/PRESENTATION/PROCESS/ajax_common.php?request=bookingdata',
            dataType: 'json',
            type: 'post',
            data: data,
            success: function (response) {
                if(response.login == '1'){
                    window.location = base_url +'/PRESENTATION/booking.php';
                }else{
                    window.location = base_url +'/PRESENTATION/login.php';
                }
                
            },
        });
    });
            $('#date').datepicker({
            dateFormat: 'yy-mm-dd',
            minDate:0,
        });
});


function getslot(base_url, data, url) {
    var html = "";
    var slno = 1;
    jQuery.ajax({
        url: base_url + '/' + url,
        dataType: 'json',
        type: 'post',
        data: data,
        success: function (response) {
            if (response.result == 1) {
                html += '<table class="table table-hover table-striped">';
                html += '<thead>';
                html += '<th>Sl No.</th>';
                html += '<th>Slot Name</th>';
                html += '<th>Payment Per Hour</th>';
                html += '<th>Booking</th>';
                html += '</thead>';
                html += '<tbody>';
                $.each(response.data, function (key, value) {
                    html += '<tr>';
                    html += '<td>' + slno + '</td>';
                    html += '<td>' + value['slot_name'] + '</td>';
                    html += '<td><button class="booking_button" id="' + value['id'] + '">Booking</button></td>';
                    html += '</tr>';
                    slno++;
                });

                html += '</tbody>';
                html += '</table>';
            } else {
                html += '<table class="table table-hover table-striped">';
                html += '<tr>';
                html += '<td colspan="4">No Records Found</td>';
                html += '</tr>';
                html += '</table>';
            }
            $('#slot-search-area').html(html);
        },
    });
}