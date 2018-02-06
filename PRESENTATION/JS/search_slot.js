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
                html += '</thead>';
                html += '<tbody>';
                $.each(response.data, function (key, value) {
                    html += '<tr>';
                    html += '<td>' + slno + '</td>';
                    html += '<td>' + value['slot_name'] + '</td>';
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