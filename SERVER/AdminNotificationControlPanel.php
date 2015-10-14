<?php
/**
 * The administration frontEnd panel, Here we can control the connected users and send notifications
 *
 *
 *
 * PHP version 5
 *
 * @author     Ettore Moretti <ettoremoretti27@gmail.com>
 * @version 1.0.0
 *
 */
require_once("core/XajaAdminServer.php");
$XS = new XajaAdminServer();
$UserData= $XS->getAllUser();
?>
<html>
<head>
	<title>XajaNotification - Admin Example</title>
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/ui-darkness/jquery-ui.css" rel="stylesheet">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
	
	<script src="js/dialog.js" type="text/javascript"></script>
	<script src="js/tablesorter.min.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		$(document).ready(function() 
		    { 
			    $("#refresh").click(function () {
			    	location.reload();
		        });
		        
		        $("#myTable").tablesorter(); 
		        
		    }); 

		
	</script>
	<style type="text/css">
			/* tables */
		table.tablesorter {
			font-family:arial;
			background-color: #CDCDCD;
			margin:10px 0pt 15px;
			font-size: 8pt;
			width: 100%;
			text-align: left;
		}
		table.tablesorter thead tr th, table.tablesorter tfoot tr th {
			background-color: #e6EEEE;
			border: 1px solid #FFF;
			font-size: 8pt;
			padding: 4px;
		}
		table.tablesorter thead tr .header {
			background-image: url(img/bg.gif);
			background-repeat: no-repeat;
			background-position: center right;
			cursor: pointer;
		}
		table.tablesorter tbody td {
			color: #3D3D3D;
			padding: 4px;
			background-color: #FFF;
			vertical-align: top;
		}
		table.tablesorter tbody tr.odd td {
			background-color:#F0F0F6;
		}
		table.tablesorter thead tr .headerSortUp {
			background-image: url(img/asc.gif);
		}
		table.tablesorter thead tr .headerSortDown {
			background-image: url(img/desc.gif);
		}
		table.tablesorter thead tr .headerSortDown, table.tablesorter thead tr .headerSortUp {
		background-color: #8dbdd8;
		}
	</style>
	
</head>
<body>
	<H3>Xaja Notification Administration - Example</H3>
	<hr />
	<img id="refresh" style="width:40px; height:40px;" src="img/refresh.jpg"  />
	 <table id="myTable" class="tablesorter">
	 <thead>
	 	<th>UserId</th>
	 	<th>User last timestamp connection</th>
	 	<th></th>
	 </thead>
	 <tbody> 
	 	<?php foreach ($UserData as $user): ?>
	 		<tr>
	 			<td><?php echo $user['id']; ?></td>
	 			<td><?php echo $user['last_client_timestamp'].' >>> <b>'.date('d/m/Y H:i:s',$user['last_client_timestamp']).'</b>'; ?></td>
	 			<td><input id="button" type="button" value="Send a notification"></td>
	 		</tr>
	 	<?php endforeach;?>
	 </tbody>
	 </table>
	 <input id="buttonToAll" type="button" value="Send to All">
	 
	 <div id="dialog" title="Notification sender" style="width: 1000px; height: auto;">
		<form action="" method="post">
				<textarea id="notification" name="notification" rows="10" cols="80" placeholder="Send..."></textarea>
		</form>
		<div id="result"></div>
	</div>

</body>
</html>
