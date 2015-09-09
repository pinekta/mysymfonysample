function set_range_date_picker(startId, endId)
{
    var startDateTextBox = $('#' + startId);
    var endDateTextBox = $('#' + endId);

    startDateTextBox.datepicker({
        dateFormat: 'yy/mm/dd',
        onClose: function( selectedDate ) {
            endDateTextBox.datepicker("option", "minDate", selectedDate);
        }
    });

    endDateTextBox.datepicker({
        dateFormat: 'yy/mm/dd',
        onClose: function( selectedDate ) {
            startDateTextBox.datepicker("option", "maxDate", selectedDate);
        }
    });
}
