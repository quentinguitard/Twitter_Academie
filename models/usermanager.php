<?php

class UserManager
{
	private $_db;

	function __construct($db)
	{
		$this->_db = $db;
	}

	public function create(User $user){
		$sql = "INSERT INTO user (fullName, displayName, mail, password, avatar, theme, registrationDate, userStatus) VALUES (?,?,?,?,?,?,now(), 'Enable')";
        $stmt = $this->_db->prepare($sql);
        $stmt->bindValue(1, $user->getFullName());
        $stmt->bindValue(2, $user->getDisplayName());
        $stmt->bindValue(3, $user->getMail());
        $stmt->bindValue(4, $user->getPassword());
        $stmt->bindValue(5, $user->getAvatar());
        $stmt->bindValue(6, $user->getTheme());
        $stmt->bindValue(7, $user->getGenre());
        $stmt->execute();	
	}

}