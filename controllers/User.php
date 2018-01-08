<?php 

class User
{
	
	private $_fullName;
	private $_displayName;
	private $_mail;
	private $_password;
	private $_avatar;
	private $_theme;
	private $_userStatus;

	function __construct(array $data)
	{
		$this->hydrate($data);
	}

	public function hydrate(array $data){

		foreach ($data as $key => $value) {
			$key = ucwords($key, '_');
			$key = 'set'.str_replace('_', '', $key);
			if(method_exists($this, $key)){
				$this->$key($value);
			}
		}
	}

	public function getFullName(){
		return $this->_fullName;
	}
	public function getDisplayName(){
		return $this->_displayName;
	}
	public function getMail(){
		return $this->_mail;
	}
	public function getPassword(){
		return $this->_password;
	}
	public function getAvatar(){
		return $this->_avatar;
	}
	public function getTheme(){
		return $this->_theme;
	}
	public function getUserStatus(){
		return $this->_userStatus;
	}

	public function setFullName($fullName){
		$this->_fullName = $fullName;
	}
	public function setDisplayName($displayName){
		$this->_displayName = $displayName;
	}
	public function setMail($mail){
		$this->_mail = $mail;
	}
	public function setPassword($password){
		$this->_password = $password;
	}
	public function setAvatar($avatar=NULL){
		$this->_avatar = $avatar;
	}
	public function setTheme($theme=NULL){
		$this->_theme = $theme;
	}
	public function setUserStatus($userStatus){
		$this->_userStatus = $userStatus;
	}		

}
