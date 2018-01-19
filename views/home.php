<?php
$database = new Database();
$db = $database->getConnection();
$usermanager = new UserManager($db); 
$gertrude = new TweetManager($db);
$row = $gertrude->showTweets($_SESSION['idUser']);
$countRow = count($row);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/home.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>Tweet Academy</title>

</head>
<body>
	<?php
	include "nav-bar.php";
	?>

	<div class="container text-center">    
		<div class="row">
			<div class="col-sm-3 well">
				<div class="well">
					<a href="index.php?controller=profile"><img src="image/unicorn.jpg" class="img-circle" height="65" width="65" alt="Avatar"></a>
					<h4><a href="index.php?controller=profile"><?php echo $usermanager->select($_SESSION['idUser'])['fullName']; ?></a></h4>
					<p><a href="index.php?controller=profile"><?php echo $usermanager->select($_SESSION['idUser'])['displayName']; ?></a></p>
				</div>
				<div class="menu-count">
					<p><a href="#">Tweet <span class="badge pull-right"> <?php echo $gertrude->countMyTweet($_SESSION['idUser'])[0]; ?> </span></a></p>
					<p><a href="#">Abonnements <span class="badge pull-right"> <?php echo $gertrude->countMyFollower($_SESSION['idUser'])[0]; ?> </span></a></p>
					<p><a href="#">Abonnés <span class="badge pull-right"> <?php echo $gertrude->countMyFollowed($_SESSION['idUser'])[0]; ?> </span></a></p>
				</div>
			</div>
			<div class="col-sm-7">

				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default text-left">
							<div class="panel-body">
								<form method="post" action="" class="form">
									<textarea class="form-control space-down" name="tweetContent" cols="2"></textarea>
									<input type="submit" class="btn btn-info" name="envoyer" value="Tweeter">
									<a type="button" class="glyphicon glyphicon-picture"></a>
								</form>  
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-9">
						

						<?php 
						$usermanager->select($_SESSION['idUser']);
						if(!empty($_POST['envoyer'])){

							$bob = new Tweet($_SESSION['idUser'], $_POST['tweetContent']);
							$gertrude->postTweet($bob);
							$_GET['controller'] = 'home';
							echo "<script> window.location.assign('index.php?controller=".$_GET['controller']."');</script>";

						}
						for($i = 0 ; $i < $countRow; $i++){ ?>


						<div class="arianne well">
							<div class="well white">

								<?php 
								
								$row_retweet = $gertrude->reTweetBy($row[$i]['idTweet']); 

								if( $row[$i]['idReTweetFrom'] !== null ){ ?>
									
								<h1><?php echo $row[$i]['displayName'] . " retweet from " .  $row_retweet["displayName"]; ?></h1>
								<p><?php echo $row[$i]['tweetContent']; ?></p>
								<p><?php echo $row[$i]['tweetDate'];?></p>

								<?php }
								else {
								?>

								<h2><?php echo $row[$i]['fullName'];?></h2>
								<h4><?php echo "@".$row[$i]['displayName']; ?></h4>
								<p><?php echo $row[$i]['tweetDate'];?></p>

								<p><?php echo $row[$i]['tweetContent']; ?></p>
								
								<?php } ?>
							</div>
							<button class="blue" onclick="toggle(event);"><span class="glyphicon glyphicon-comment"></span></button>
							<button class="blue" onclick="reTweet(<?php echo $row[$i]['idTweet']; ?>)"><span class="glyphicon glyphicon-retweet"></span></button>
							<div class="toggle-comment">
								<form method="post" action="" class="form">
									<textarea class="form-control space-down" name="commentContent-<?php echo $i; ?>" cols="1	"></textarea>
									<input type="submit" class="btn btn-info" name="comment" value="Comment">
								</form>
							</div>
						</div>
						
					<?php
						if(!empty($_POST['comment'])){
							if(isset($_POST["commentContent-$i"])){
								var_dump($row[$i]['idTweet']);
								echo $_POST["commentContent-$i"];
								$gertrude->tweetComment($_SESSION['idUser'], $row[$i]['idTweet'], $_POST["commentContent-$i"]);

							}
						}

					}

					?>
				</div>
			</div>

		</div>
		<div class="col-sm-2 well">
			<div class="thumbnail">
				
			</div>      
			<div class="well">
		
			</div>
			<div class="well">
			
			</div>
		</div>
	</div>
</div>

<footer class="container-fluid text-center">
	<p><span class="glyphicon glyphicon-copyright-mark"> Tweet Academy</span></p>
</footer>

<script>
	function reTweet(idTweet){
		$.get('?controller=ReTweet&action=reTweet&idTweet=' + idTweet).then(() => {
			console.log('retweet');
			window.location.assign('index.php?controller=home');

		})
	}

	function toggle(event){
			   console.log($(event.target).siblings(".toggle-comment"));

			 $(event.target).siblings(".toggle-comment").css("display", "initial");
			    
			}

</script>
</body>
</html>

