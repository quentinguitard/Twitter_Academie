<?php
$database = new Database();
$db = $database->getConnection();
$usermanager = new UserManager($db); 
$gertrude = new TweetManager($db);

$row = $gertrude->showTweets($_SESSION['idUser']);


$gertrude->reTweet(1, $_SESSION['idUser']);

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
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>Tweet Academy</title>
</head>
<body>

	<nav class="navbar navbar-default">
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
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">



				<ul class="nav navbar-nav">
					<li><a href="index.php?controller=home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Acceuil<span class="sr-only"></span></a></li>
					<li><a href="#"><span class="glyphicon glyphicon-bell" aria-hidden="true"></span> Notifications</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Messages</a></li>
					<li><img src="image/logo.png" /><a class="navbar-brand" href="#">Tweet Academy</a></li>
				</ul>

				<form class="navbar-form navbar-left">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search">
					</div>
					<button type="submit" class="glyphicon glyphicon-search"></button>
				</form>

				<div class="btn-group">
					<button type="button" class="btn btn-info">Tweeter</button>

				</div>

			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>



	<div class="container text-center">    
		<div class="row">
			<div class="col-sm-3 well">
				<div class="well">
					<p><a href="#">My Profile</a></p>
					<img src="bird.jpg" class="img-circle" height="65" width="65" alt="Avatar">
				</div>
				<div class="well">
					<p><a href="#">Interests</a></p>
					<p>
						<span class="label label-default">News</span>
						<span class="label label-primary">W3Schools</span>
						<span class="label label-success">Labels</span>
						<span class="label label-info">Football</span>
						<span class="label label-warning">Gaming</span>
						<span class="label label-danger">Friends</span>
					</p>
				</div>
				<div class="alert alert-success fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
					<p><strong>Ey!</strong></p>
					People are looking at your profile. Find out who.
				</div>
				<p><a href="#">Link</a></p>
				<p><a href="#">Link</a></p>
				<p><a href="#">Link</a></p>
			</div>
			<div class="col-sm-7">

				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default text-left">
							<div class="panel-body">
								<form method="post" action="">
									<input name="tweetContent" type="textarea">
									<input type="submit" class="btn btn-info" name="envoyer" value="Tweeter">
									<a type="button" class="glyphicon glyphicon-picture"></a>
								</form>  
							</div>
						</div>
					</div>
				</div>

				<div class="row">

					<div class="col-sm-9">
						<div class="well">
							<p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-9">
						<div class="well">
							<p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
						</div>
					</div>
				</div>
				<div class="row">
					
					<div class="col-sm-9">
						<div class="well">
							<p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
						</div>
					</div>
				</div>
				<div class="row">
					
					<div class="col-sm-9">
						<div class="well">
							<p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
						</div>
					</div>
				</div>     
			</div>
			<div class="col-sm-2 well">
				<div class="thumbnail">
					<p>Upcoming Events:</p>
					<img src="paris.jpg" alt="Paris" width="400" height="300">
					<p><strong>Paris</strong></p>
					<p>Fri. 27 November 2015</p>
					<button class="btn btn-primary">Info</button>
				</div>      
				<div class="well">
					<p>ADS</p>
				</div>
				<div class="well">
					<p>ADS</p>
				</div>
			</div>
		</div>
	</div>

	<footer class="container-fluid text-center">
		<p>Footer Text</p>
	</footer>

</body>
</html>


















<h1>VOILA</h1>

<form method="post" action="">
	<input name="tweetContent" type="textarea">
	<input type="submit" name="envoyer" value="envoyer">
</form>


<h2>Joyeux Anniversaire</h2>
<?php 


$usermanager->select($_SESSION['idUser']);


if(!empty($_POST['envoyer'])){


	$bob = new Tweet($_SESSION['idUser'],$_POST['tweetContent']);

	var_dump($bob);

	$gertrude->postTweet($bob);

}





for($i = 0 ; $i < $countRow; $i++){ ?>
<h1><?php echo $row[$i]['displayName']; ?></h1>
<p><?php echo $row[$i]['tweetContent']; ?></p>
<?php
}

?>

</body>
</html>