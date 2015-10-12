<?php
/**
 * Here intercept the ajax call for the client
 *
 * 
 * PHP version 5
 *
 * @author     Ettore Moretti <author@example.com>
 * @version 1.0.0
 *  
 */
set_time_limit(0);

require_once 'core/XajaServer.php';

// Retrieving the last timestamp
$lastTimestamp=isset( $_GET['timestamp'])? $_GET['timestamp']: 0 ;

// Retrieving the uid
$uid=isset( $_GET['id'])? $_GET['id']: 0 ;

//XajaServerClass instance and polling start
$XS= new XajaServer($lastTimestamp,$uid);
	$XS->StartLongPoll();
