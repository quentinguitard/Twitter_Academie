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
                $stmt = $this->_db->prepare($sql);

                $stmt->bindValue(1, $user->getFullName(), PDO::PARAM_STR);
                $stmt->bindValue(2, $user->getDisplayName(), PDO::PARAM_STR);
                $stmt->bindValue(3, $user->getMail(), PDO::PARAM_STR);
                $stmt->bindValue(4, hash('ripemd160',$user->getPassword()), PDO::PARAM_STR);
                $stmt->execute();	

        }

        public function select($id){
                $sql = "SELECT * FROM user WHERE idUser = " . $id;
                $stmt = $this->_db->query($sql);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return new $user($row['fullName'],$row['displayName'], $row['mail'], $row['password'], $row['avatar'], $row['theme'], $row['registrationDate'], $row['userStatus']);
        }

        public function exist($mail, $password){
                $sql = "SELECT idUser, mail, password FROM user WHERE mail = '$mail'";
                $stmt = $this->_db->query($sql);
                $row = $stmt->fetch();
                if($row['password'] == hash('ripemd160',$password)){
                        $exist = array($row['idUser'], true);
                        return $exist; 
                }
                else{
                        echo "Connection failed. Wrong user or password";
                }
        }

}

