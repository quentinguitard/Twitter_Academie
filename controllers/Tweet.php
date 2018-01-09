<?php 

class Tweet {

	private $_idUser;
	private $_tweetContent;
	private $_tweetImg;
	private $_idReTweet;
	private $_idReTweetFrom;
	private $_deleted;

	public function __construct($idUser, $tweetContent, $tweetImg = null, $idReTweet = null, $idReTweetFrom = null, $deleted = true){

		$this->setIdUser($idUser);
		$this->setTweetContent($tweetContent);
		$this->setTweetImg($tweetImg);
		$this->setIdReTweet($idReTweet);
		$this->setIdReTweetFrom($idReTweetFrom);
		$this->setDeleted($deleted);

	}

	public function getIdUser(){
		return $this->_idUser;
	}
	public function getTweetContent(){
		return $this->_tweetContent;
	}
	public function getTweetImg(){
		return $this->_tweetImg;
	}
	public function getIdReTweet(){
		return $this->_idReTweet;
	}
	public function getIdReTweetFrom(){
		return $this->_idReTweetFrom;
	}
	public function getDeleted(){
		return $this->_deleted;
	}

	public function setIdUser($idUser){
		$this->_idUser = $idUser;
	}
	public function setTweetContent($tweetContent){
		$this->_tweetContent = $tweetContent;
	}
	public function setTweetImg($tweetImg = null){
		$this->_tweetImg = $tweetImg;
	}
	public function setIdReTweet($idReTweet = null){
		$this->_idReTweet = $idReTweet;
	}
	public function setIdReTweetFrom($idReTweetFrom = null){
		$this->_idReTweetFrom = $idReTweetFrom;
	}
	public function setDeleted($deleted = true){
		$this->_deleted = $deleted;
	}

}

