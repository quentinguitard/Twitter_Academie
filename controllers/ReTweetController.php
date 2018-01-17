<?php 

class ReTweetController {

	function reTweet(){
			$idTweet = $_GET['idTweet'];
			var_dump($idTweet);
			$database = new Database();
			$db = $database->getConnection();
			$usermanager = new UserManager($db); 
			$gertrude = new TweetManager($db);
			$row = $gertrude->reTweet($idTweet, $_SESSION['idUser']);
		}
}
?>