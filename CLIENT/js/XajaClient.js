/* 
 * Author: Ettore Moretti
 * Description: This JavaScript code includes functions for calls to the server and for displaying the final notification.
*/

var SERVERLNK="http://localhost/laboratorio/xajanotifier/SERVER/";

function longPollNotification() {
    $.ajax({
        type: "GET",
        url: SERVERLNK+"HttpLongPoll.php?timestamp=" + XajaSettings.timestamp + "&id=" + XajaSettings.uid,
        async: true,
        cache: false,

        success: function(data) {
            var json = eval('(' + data + ')');
            if (json['msg'] != "") {
                $("#notification").empty();
                $("#notification").append(json['msg']);
                $('#notification').animate({
                    top: "0"
                }, 500);
            }
            timestamp = json["last_server_timestamp"];
            setTimeout("longPollNotification()", 1000);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            setTimeout("longPollNotification()", 15000);
        }
    });
}

$(document).ready(function() {
    //Start long polling
	longPollNotification();

    //Hide notification div
    messagesHeight = $('#notification').outerHeight();
    $('#notification').css('top', -messagesHeight); //move element outside viewport  

    // When notification is clicked, hide it
    $('#notification').click(function() {
        $(this).animate({
            top: -$(this).outerHeight()
        }, 500);
    });

});
