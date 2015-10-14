<?php
/**
 * XajaAdminServer class
 *
 * Here resides the core of the administration panel, where we update the notification table
 *
 *
 * PHP version 5
 *
 * @author     Ettore Moretti <ettoremoretti27@gmail.com>
 * @version 1.0.0
 *
 */
include_once ("core/config.php");

class XajaAdminServer {
	
	private $DB;
	
	public function __construct() {
		$this->DB = new PDO ( "mysql:host=".Config::DB_HOST.";dbname=".Config::DB_NAME."", Config::DB_USER, Config::DB_PSWD );
		$this->clearOldUser();
	}
	
	public function SendNotification($notification,$uid){
	 $null = null;
	 if($uid=='*'){
	 	$stmt = $this->DB->prepare ( "UPDATE xaja_user SET last_server_timestamp=:lstime, msg=:msg" );
	 	$stmt->bindParam ( ':lstime', time() );
	 	$stmt->bindParam ( ':msg', $notification );
	 }else{
		 $stmt = $this->DB->prepare ( "UPDATE xaja_user SET last_server_timestamp=:lstime, msg=:msg WHERE ID=:id" );
		 $stmt->bindParam ( ':id', $uid );
		 $stmt->bindParam ( ':lstime', time() );
		 $stmt->bindParam ( ':msg', $notification );
	 }
	 $stmt->execute ();
	 
	 $return=array();

	 if($stmt->execute ())
	 	$return['ret']=0;
	 	
	 else 
	 	$return['ret']=1;
	 	
	 	
	 	echo json_encode($return);
	}
	
	public function getAllUser(){
	
		$stmt = $this->DB->prepare ( 'SELECT * FROM xaja_user' );
		$stmt->execute ();
		$result = $stmt->fetchAll ( PDO::FETCH_ASSOC );
	
		return $result;
	}
	
	
	private function clearOldUser() {
		$stmt = $this->DB->prepare ( 'DELETE FROM xaja_user WHERE last_client_timestamp < (UNIX_TIMESTAMP() - ' . Config::DELETE_AFTER_SECONDS . ')' );
		$stmt->execute ();
	}
	

}
