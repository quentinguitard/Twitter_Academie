<?php 
require "controllers/HomeController.php";
require "controllers/AuthController.php";
require "controllers/User.php";
require "controllers/Tweet.php";
require "controllers/ProfileController.php";
require "controllers/EditProfileController.php";
require "models/tweetmanager.php";
require "models/database.php";
require "models/usermanager.php";


session_start();
$_controller = isset($_GET['controller']) ? $_GET['controller'] : 'auth';
$_action = isset($_GET['action']) ? $_GET['action'] : 'index';
$controller_name = ucfirst($_controller) . 'Controller';
if(class_exists($controller_name)){
$controller = new $controller_name();
	if(method_exists($controller, $_action)){
		$controller->{ $_action }();
	}
}
else{
	die('Class '. $controller_name . ' not found');
}


?>