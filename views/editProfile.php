<?php
$database = new Database();
$db = $database->getConnection();
$usermanager = new UserManager($db); 

$userFullName = $usermanager->select($_SESSION['idUser'])['fullName'];
$userDisplayName = $usermanager->select($_SESSION['idUser'])['displayName'];
$userMail = $usermanager->select($_SESSION['idUser'])['mail'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="style/home.css">
    <title>Tweet Academy</title>
</head>
	<body>
<?php
include "nav-bar.php";
?>

		<div class="container">
			<form method="post" action="" class="form-horizontal">
	            <div class="form-group">
	            	<label>Nom Prénom</label>
	                <input type="text" class="form-control" id="fullName" name='fullName' placeholder="Nom Prénom" value="<?php echo $userFullName; ?>">
	            </div>

	            <div class="form-group">
	            	<label>Pseudo</label>
	                <input type="text" class="form-control" id="displayName" name="displayName" placeholder="Pseudo" value="<?php echo $userDisplayName; ?>">
	            </div>

	            <div class="form-group">
	            	<label>Theme :</label>
		            	<select class="form-control" name="theme">
		            		<option value="Blue">Blue</option>
		            		<option value="Red">Red</option>
		            		<option value="Green">Green</option>
		            		<option value="Pink">Pink</option>
		            		<option value="Yellow">Yellow</option>
		            	</select>
	            	
	            </div>

	            	<div class="form-group">
						<label>Avatar</label>
						<div class="input-group input-file">
							<span class="input-group-btn">
								<button class="btn btn-default btn-choose" type="button">Choose</button>
							</span>
							<input type="text" class="form-control" placeholder='Choose a file...' name="idUrlAvatar" />
							<span class="input-group-btn">
								<button class="btn btn-warning btn-reset" type="button">Reset</button>
							</span>
						</div>
					</div>


	            <div class="form-group">
	                <div class="col-sm-12 controls">
	                    <input type="submit" name="envoyer" value="Modifier" id="btn-login" class="btn btn-success">
	                </div>

			</form>
		</div>
<?php
if(!empty($_POST['envoyer']) && !empty($_POST['displayName']) && !empty($_POST['fullName'])){

    	$usermanager->update($_SESSION['idUser'], $_POST['fullName'], $_POST['displayName'], $_POST['theme']);
		$_GET['controller'] = 'profile';
		echo "<script> window.location.assign('index.php?controller=".$_GET['controller']."'); </script>";

}
?>
	</body>

</html>