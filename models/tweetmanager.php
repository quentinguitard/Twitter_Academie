<?php 


Class TweetManager {

    private $_db;

    function __construct($db)
    {
    	$this->_db = $db;
    }

    public function postTweet(Tweet $tweet){
    	$sql = "INSERT INTO tweet (idUser, tweetContent) VALUES (?,?)";

    	$stmt = $this->_db->prepare($sql);
    	$stmt->bindValue(1, $tweet->getIdUser(), PDO::PARAM_STR);
        $stmt->bindValue(2, $tweet->getTweetContent(), PDO::PARAM_STR);
        $stmt->execute();

    }
    public function showTweets($id){

    	$sql = "SELECT idTweet, tweetContent, tweetDate, idReTweetFrom, user.displayName FROM tweet 
				JOIN follow ON follow.idFollowed=tweet.idUser
				JOIN user ON user.idUser = tweet.idUser
				WHERE idFollower ='".$id."' AND idFollowed = (SELECT idFollowed FROM follow WHERE idFollower = '".$id."')
				UNION
				SELECT idTweet, tweetContent, tweetDate, idReTweetFrom, user.displayName FROM tweet 
				JOIN user ON user.idUser = tweet.idUser
				WHERE tweet.idUser=".$id."
				ORDER BY tweetDate DESC";

    	$stmt = $this->_db->query($sql);
    	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

    public function reTweetBy($idTweet){
        $sql = "SELECT displayName FROM user JOIN tweet ON idReTweetFrom = user.idUser WHERE tweet.idTweet = ".$idTweet;
        $stmt = $this->_db->query($sql);
        $row = $stmt->fetch();
        return $row;
    }

    public function showMyTweet($id){
        $sql = "SELECT idTweet, tweetContent, tweetDate, idReTweetFrom, user.displayName FROM tweet 
                JOIN user ON user.idUser = tweet.idUser
                WHERE tweet.idUser=".$id."
                ORDER BY tweetDate DESC";
        $stmt = $this->_db->query($sql);
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

    public function reTweet($idTweet, $idUser){
    	$sql = "SELECT tweetContent FROM tweet WHERE idTweet = ".$idTweet;
    	$stmt = $this->_db->query($sql);
    	$contentTweet = $stmt->fetch();

    	$sql = "SELECT idUser FROM tweet WHERE idTweet = ".$idTweet;
    	$stmt = $this->_db->query($sql);
    	$idReTweetFrom = $stmt->fetch();

    	$sql = "INSERT INTO tweet (idUser, tweetContent, idReTweet,idReTweetFrom) VALUES (?,?,?,?)";
    	$stmt = $this->_db->prepare($sql);
    	$stmt->bindValue(1, $idUser);
    	$stmt->bindValue(2, $contentTweet['tweetContent']);
    	$stmt->bindValue(3, $idTweet);
    	$stmt->bindValue(4, $idReTweetFrom['idUser']);
    	$stmt->execute();
    	
    }

}
