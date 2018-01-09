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
    public function showMyTweets($id){
    	$sql = "SELECT tweetContent, user.displayName FROM tweet JOIN user ON user.idUser = tweet.idUser WHERE user.idUser =" .$id;
    	$stmt = $this->_db->query($sql);
    	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    	var_dump($row);
        return $row;
    } 

}
