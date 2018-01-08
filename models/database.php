<?php

class Database
{
	private $_servername = "localhost";
	private $_username = "root";
	private $_password = "";
	private $_db = 'tweet_academie';
	public $conn;

	public function getConnection()
	{
		$this->conn = NULL;
		try {
			$this->conn = new PDO("mysql:host=".$this->_servername.";dbname=".$this->_db, $this->_username, $this->_password);
				
			    }
			catch(PDOException $e)
			    {
			    echo "Connection failed: " . $e->getMessage();
			    }

		return $this->conn;
	}
	
}