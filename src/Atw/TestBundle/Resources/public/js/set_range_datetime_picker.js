function set_range_datetime_picker(startId, endId)
{
    var startDateTextBox = $('#' + startId);
    var endDateTextBox = $('#' + endId);

    var defOpt = {
        dateFormat: 'yy/mm/dd',
        timeFormat: 'HH:mm:ss'
    };
    var startOpt = {
        hour: '00',
        minute: '00',
        second: '00'
    };
    var endOpt = {
        hour: '23',
        minute: '59',
        second: '59'
    };

    startDateTextBox.datetimepicker($.extend({}, defOpt, startOpt, {
        onClose: function( selectedDate ) {
            var minDateTime = null;
            var minHour, minMinute, minSecond = 0;
            if (selectedDate) {
                minDateTime = new Date(selectedDate);
                minHour = minDateTime.getHours();
                minMinute = minDateTime.getMinutes();
                minSecond = minDateTime.getSeconds();
            }
            endDateTextBox.datetimepicker("option", "minDate", minDateTime);
            endDateTextBox.datetimepicker("option", "hourMin", minHour);
            endDateTextBox.datetimepicker("option", "minuteMin", minMinute);
            endDateTextBox.datetimepicker("option", "secondMin", minSecond);
        }
    }));

    endDateTextBox.datetimepicker($.extend({}, defOpt, endOpt, {
        onClose: function( selectedDate ) {
            var maxDateTime = null;
            var maxHour, maxMinute, maxSecond = 0;
            if (selectedDate) {
                maxDateTime = new Date(selectedDate);
                maxHour = maxDateTime.getHours();
                maxMinute = maxDateTime.getMinutes();
                maxSecond = maxDateTime.getSeconds();
            }
            startDateTextBox.datetimepicker("option", "maxDate", maxDateTime);
            startDateTextBox.datetimepicker("option", "hourMax", maxHour);
            startDateTextBox.datetimepicker("option", "minuteMax", maxMinute);
            startDateTextBox.datetimepicker("option", "secondMax", maxSecond);
        }
    }));
}
