<?php 
//Start the session to store the uniqid
session_start();
(!isset($_SESSION['UID']))?$_SESSION['UID']=uniqid():'';
?>
<html>
<head>
	<title>XajaNotification - Example</title>
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/ui-darkness/jquery-ui.css" rel="stylesheet">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
	<script type="text/javascript">
	  var XajaSettings = {
			  uid: '<?= $_SESSION['UID'] ?>',
			  timestamp: Math.floor($.now()/1000)
	  }
	</script>
	<script src="js/XajaClient.js" type="text/javascript" ></script>
	<style type="text/css">
	.notification{
	    background-size: 40px 40px;
	    background-image: linear-gradient(135deg, rgba(255, 255, 255, .05) 25%, transparent 25%,
	                        transparent 50%, rgba(255, 255, 255, .05) 50%, rgba(255, 255, 255, .05) 75%,
	                        transparent 75%, transparent);                                      
	     box-shadow: inset 0 -1px 0 rgba(255,255,255,.4);
	     width: 100%;
	     border: 1px solid;
	     color: #fff;
	     padding: 15px;
	     position: fixed;
	     _position: absolute;
	     text-shadow: 0 1px 0 rgba(0,0,0,.5);
	     animation: animate-bg 5s linear infinite;
	     background-color: #61b832;
	     border-color: #55a12c;
	}
	
	.notification h3{
	     margin: 0 0 5px 0;                                                  
	}
	
	.notification p{
	     margin: 0;                                                  
	}
	
	@keyframes animate-bg {
	    from {
	        background-position: 0 0;
	    }
	    to {
	       background-position: -80px 0;
	    }
	}
	</style>
</head>
<body>
	<H3>Xaja Notification Client - Example page</H3>
	<hr />
	<div id="notification" class="notification">aaa</div>
</body>
</html>
