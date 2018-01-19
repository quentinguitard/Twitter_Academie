<?php
$database = new Database();
$db = $database->getConnection();
$usermanager = new UserManager($db); 
$gertrude = new TweetManager($db);

$row = $gertrude->showMyTweet($_SESSION['idUser']);

$countRow = count($row);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/home.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>Profil</title>
</head>
<body>
	<?php
	include "nav-bar.php";
	?>
	<div class="banniere">
		<img src="image/wallpaper.jpg" width="100%" height="400">
	</div>

	<nav class="navbar navbar-default middle">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse mid" id="bs-example-navbar-collapse-1 ">


				<div class="btn-group edit">
					<a href="index.php?controller=editProfile"><button type="button" class="btn btn-default">Editer profil</button></a>

				</div>

				<div class="nav-tweet">
					<ul class="nav navbar-nav">
						<li><a href="#"> Tweet </br> <span class="badge pull-right"> 26 </span></a></li>
						<li><a href="#"> Abonnements </br> <span class="badge pull-right"> 26 </span></a></li>
						<li><a href="#"> Abonnés </br> <span class="badge pull-right"> 26 </span></a></li>
					</ul>
				</div>


			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>

	<div class="container text-center">    
		<div class="row">
			<div class="col-sm-3 well">
				<div class="well">
					
					<img src="image/unicorn.jpg" class="img-circle" height="200" width="200" alt="Avatar">
				</div>
				
				
				<h1><a href="#"><?php echo $usermanager->select($_SESSION['idUser'])['fullName']; ?></a></h1>

				<p><a href="#"><?php echo $usermanager->select($_SESSION['idUser'])['displayName']; ?></a></p>
				

				
			</div>
			<div class="col-sm-7">

				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default text-left">
							<div class="panel-body">
								<form method="post" action="">
									<textarea class="form-control space-down" name="tweetContent" cols="3"></textarea>
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
							$_GET['controller'] = 'profile';
							echo "<script> window.location.assign('index.php?controller=".$_GET['controller']."');</script>";

						}
						for($i = 0 ; $i < $countRow; $i++){ ?>
						<div class="arianne well">
							<div class="well">
								<?php 
								
								$row_retweet = $gertrude->reTweetBy($row[$i]['idTweet']); 

								if( $row[$i]['idReTweetFrom'] !== null ){ ?>
									
								<h1><?php echo $row[$i]['displayName'] . " retweet from " .  $row_retweet["displayName"]; ?></h1>
								<p><?php echo $row[$i]['tweetContent']; ?></p>
								<p><?php echo $row[$i]['tweetDate'];?></p>
								<?php }
								else {
								?>
								<h1><?php echo $row[$i]['displayName']; ?></h1>
								<p><?php echo $row[$i]['tweetContent']; ?></p>
								<p><?php echo $row[$i]['tweetDate'];?></p>
								<?php } ?>
							</div>

							<button class="blue" onclick="toggle(event);"><span class="glyphicon glyphicon-comment"></span></button>
							<button class="blue" onclick="reTweet(<?php echo $row[$i]['idTweet']; ?>)"><span class="glyphicon glyphicon-retweet"></span></button>
						
						</div>

						
						<?php
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
			window.location.assign('index.php?controller=profile');
		})
	}

	function toggle(event){
			   console.log($(event.target).siblings(".toggle-comment"));

			 $(event.target).siblings(".toggle-comment").css("display", "initial");
			    
			}

</script>
</body>
</html>