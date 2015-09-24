<?php

class db{
	
	protected $con;
	protected $host;
	protected $user;
	protected $pass;
	protected $db_name;
	
	public function __construct(){
		$this->host = DB_HOST;
		$this->user = DB_HOST_USER;
		$this->pass = DB_HOST_PASS;
		$this->db_name = DB_NAME;
		$this->createConn();
	}
	
	public function createDb(){
			
		$qryDb = 'CREATE DATABASE IF NOT EXISTS '.$this->db_name.' CHARACTER SET utf8 COLLATE utf8_general_ci;';
		$resDb = mysql_query($qryDb) or die('Error creating database: '.mysql_error($this->con));
		if($resDb)
		{	
			mysql_select_db($this->db_name, $this->con);
			$this->createTable();
		}
	}
	public function createTable(){
		$qryTable = "CREATE TABLE IF NOT EXISTS `tbl_urls` (
			  `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			  `link` varchar(255) default NULL,
			  `short_url` varchar(6) default NULL,
			  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  `client_ip` varchar(255) default NULL,
			   INDEX `idx_short_url` (`short_url`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
		$resTable = mysql_query($qryTable)or die('Error creating Table: '.mysql_error($this->con));
		return $resTable;
	}
	
	public function createConn(){
		
		if(!isset($this->con))
			$this->con = mysql_connect($this->host, $this->user, $this->pass) or die('Error connecting Host '.$this->host); 
		
		if($this->con)
			$this->createDb();
	}
}
?>
