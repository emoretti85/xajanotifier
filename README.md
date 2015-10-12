# xajanotifier

What is XajaNotifier?
XajaNotifier is a solution designed to send notifications to users browsing your site in real-time. 
Using the technique of reverse ajax through the implementation of long polling.



What I could use?
Could be very useful in case you want to send any message to all your users online fast and non-invasive.


How do I configure?
Db side, import the table that you will find in the package.
Server side, change configurations to connect to the db in config.php.
Client side configuration is the only one in the script js, where you specify the server address.


Known issues
- deliberately (to make scripts as customizable as possible) has been given the opportunity to inject JavaScript code in the message
	if not you need it, you may want to inhibit such a possibility ... 
	File NotificationSender.php 
	Replace: 
		$XS->SendNotification($notification,$uid);
	with:
		$XS->SendNotification(htmlentities($notification),$uid);
