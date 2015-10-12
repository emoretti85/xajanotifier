<?php
/**
 * Here intercept the ajax call for the administration panel
 *
 * 
 *
 * PHP version 5
 *
 * @author     Ettore Moretti <author@example.com>
 * @version 1.0.0
 *
 */
set_time_limit(0);

require_once 'core/XajaAdminServer.php';

// Retrieving the last timestamp
$notification=isset( $_GET['notification'])? $_GET['notification']: 0 ;

// Retrieving the uid
$uid=isset( $_GET['id'])? $_GET['id']: 0 ;

//XajaServerClass instance and send notification 
$XS= new XajaAdminServer();

$XS->SendNotification($notification,$uid);
