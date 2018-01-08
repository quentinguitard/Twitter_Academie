<?php

class UserManager
{
	private $_db;

	function __construct($db)
	{
		$this->_db = $db;
	}

	public function create(User $user){
		$sql = "INSERT INTO user (fullName, displayName, mail, password) VALUES (?,?,?,?)";
                var_dump($sql);
                $stmt = $this->_db->prepare($sql);

                $stmt->bindValue(1, $user->getFullName(), PDO::PARAM_STR);
                $stmt->bindValue(2, $user->getDisplayName(), PDO::PARAM_STR);
                $stmt->bindValue(3, $user->getMail(), PDO::PARAM_STR);
                $stmt->bindValue(4, $user->getPassword(), PDO::PARAM_STR);
                $stmt->execute();	

	}

}

