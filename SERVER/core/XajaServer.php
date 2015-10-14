<?php

/**
 * XajaServer class 
 *
 * Here resides the core of the long polling and connected clients requests are serviced 
 * 
 * 
 * PHP version 5
 *
 * @author     Ettore Moretti <ettoremoretti27@gmail.com>
 * @version 1.0.0
 *  
 */

require_once ("core/config.php");

class XajaServer {
	private $DB,$lastClientTimestamp, $uid,$lastServerTimestamp;

	public function __construct($timestamp, $uid) {
			$this->lastClientTimestamp = $timestamp;
			$this->uid = $uid;
			
			$this->DB = new PDO ( "mysql:host=".Config::DB_HOST.";dbname=".Config::DB_NAME."", Config::DB_USER, Config::DB_PSWD );
			
			$this->clearOldUser ();
			$this->registerUser ();
	}
	
	public function StartLongPoll() {
		$this->lastServerTimestamp = $this->getLastServerTimestamp ();
		
		while ( $this->lastServerTimestamp <= $this->lastClientTimestamp ) {
			usleep ( Config::POLL_WAIT_SECONDS * 1000 );
			clearstatcache ();
			$this->lastServerTimestamp = $this->getLastServerTimestamp ();
		}
		
		$response = $this->getUserData ();
		echo json_encode ( $response );
	}
	
	private function getUserData() {
		$stmt = $this->DB->prepare ( 'SELECT last_server_timestamp,msg FROM xaja_user WHERE id=:id' );
		$stmt->bindParam ( ':id', $this->uid, PDO::PARAM_STR );
		$stmt->execute ();
		$result = $stmt->fetchAll ( PDO::FETCH_ASSOC );
		
		return $result [0];
	}
	
	private function getLastServerTimestamp() {
		$stmt = $this->DB->prepare ( 'SELECT last_server_timestamp FROM xaja_user WHERE id=:id' );
		$stmt->bindParam ( ':id', $this->uid, PDO::PARAM_STR );
		$stmt->execute ();
		$result = $stmt->fetchAll ( PDO::FETCH_ASSOC );
		
		if ($result [0] ['last_server_timestamp'])
			return $result [0] ['last_server_timestamp'];
		else
			return 0;
	}
	
	private function clearOldUser() {
		$stmt = $this->DB->prepare ( 'DELETE FROM xaja_user WHERE last_client_timestamp < (UNIX_TIMESTAMP() - ' . Config::DELETE_AFTER_SECONDS . ')' );
		$stmt->execute ();
	}
	
	private function registerUser() {
		$null = null;

			$stmt = $this->DB->prepare ( "REPLACE INTO xaja_user VALUES (:id, :lctime, :lstime, :msg)" );
			$stmt->bindParam ( ':id', $this->uid );
			$stmt->bindParam ( ':lctime', $this->lastClientTimestamp );
			$stmt->bindParam ( ':lstime', $null );
			$stmt->bindParam ( ':msg', $null );
			$stmt->execute ();

	}
}
