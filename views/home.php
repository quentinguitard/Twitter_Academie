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
        <h1>VOILA</h1>
        <h2>Joyeux Anniversaire</h2>
<?php 
var_dump($_SESSION['idUser']);
?>

	</body>
</html>