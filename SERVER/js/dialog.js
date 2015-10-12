/* 
 * Author: Ettore Moretti
 * Description: This JavaScript code includes functions for display the dialog panel in the administration page
*/

$(document).ready(function() {
	$(function() {
			$("#dialog").dialog({
				 resizable: false,
				width:'auto',
				modal:true,
				autoOpen: false,
				buttons:{
					'Send': function(){
						$.ajax({
					        type: "GET",
					        url: "NotificationSender.php?notification=" + $(this).find('textarea').val() + "&id=" + $(this).data('userId'),
					        async: true,
					        cache: false,
					        context: $(this),
					        success: function(data) {
					            var json = eval('(' + data + ')');
					            
					            if (json['ret'] == 0) {
					            	$("#dialog").find('#result').html("Notification sended!.");
					            	setTimeout( function() {  refresh(); }, 1500);
					            }else{
					            	$("#dialog").find('#result').html("Notification error!.");
					     
					            	 setTimeout( function() {  refresh(); }, 1500);
					            }
					        },
					        error: function(XMLHttpRequest, textStatus, errorThrown) {
					        	$("#dialog").find('#result').html("Notification error!.");
					        }
					    });
					},
					"Close": function() { 
						setTimeout( function() {  refresh(); }, 2000);
				    }  
				}
			});
			
			$(":button").on("click", function() {
				var uid= $(this).parents().siblings(":first").text();
					$("#dialog").data('userId',uid).dialog("open");
			});
			
			$("#buttonToAll").on("click", function() {
				var uid= "*";
					$("#dialog").data('userId',uid).dialog("open");
			});
			buttonToAll
	});
	
	function refresh() {
		location.reload();
	}
	
});
