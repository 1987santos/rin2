// Open the datepicker
$('.datepicker').datepicker({  
    format: 'yyyy-mm-dd'
}); 

// mark the notification ad read and remove from list and decrease the notification counter
$('.notify_action').on('click', function () {
    var obj = $(this);
    var notif_id = obj.attr('data-notify-id');
    $.ajax({
        type: 'GET',
        url: "/notification/markasread?id="+notif_id,
        dataType: "text",
        success: function(resultData) { 
            obj.remove();
            $('#notification_count').html($('#notification_count').text() - 1);
        }
    });
});