<?php
$database = new Database();
$db = $database->getConnection();
$usermanager = new UserManager($db); 
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<title>Tweet Academy</title>
	</head>
	<body>
		<h1>HOME</h1>
		<h2>Bienvenu sur tweet academy</h2>

		<form method="post" action="">
			<div class="form-group">
				<label for="mail">Email address :</label>
				<input type="mail" class="form-control" id="mail" name="mail">
			</div>
			<div class="form-group">
				<label for="password">Password :</label>
				<input type="password" class="form-control" id="password" name="password">
			</div>
			<div class="form-group">
				<label for="fullName">Nom Prenom</label>
				<input type="text" class="form-control" id="fullName" name='fullName'>
			</div>
			<div class="form-group">
				<label for="displayName">Pseudo</label>
				<input type="text" class="form-control" id="displayName" name="displayName">
			</div>
			<div class="form-group">
				<input type="submit" name="envoyer" value="Envoyer" class="btn btn-default">
			</div>
<?php 
if(!empty($_POST['envoyer']) && !empty($_POST['displayName']) && !empty($_POST['fullName']) && !empty($_POST['mail']) && !empty($_POST['password'])){
	$user = new User([
		'displayName' => $_POST['displayName'],
		'fullName' => $_POST['fullName'],
		'mail' => $_POST['mail'],
		'password' => $_POST['password']
		]);
	$usermanager->create($user);
}
?>
	</body>
</html>