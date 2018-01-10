<?php
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'tweet_academie');

$term = $_REQUEST['term'];
$return_arr = array();
    $conn = new PDO("mysql:host=".DB_SERVER.";port=8889;dbname=".DB_NAME, DB_USER, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->query("SELECT fullName FROM user WHERE fullName LIKE '%'".$term."'%'");
    
    while($row = $stmt->fetch_assoc()) {
        array_push($return_arr, $row['fullName']);
    }
echo json_encode($return_arr);
?>