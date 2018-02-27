<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
 

include_once '../config/database.php';
include_once '../object/user.php';
 

$database = new Database();
$dbObj = $database->getConnection();
 

$userObj = new User($dbObj);
 
$userObj->id = isset($_GET['id']) ? $_GET['id'] : die();
 

$userObj->readOne();

$user_arr = array(
    "id" =>  $userObj->id,
    "name" => $userObj->name,
    "email" => $userObj->email,
    "gender" => $userObj->gender,
    "about" => $userObj->about,
    "contact" => $userObj->contact
 
);
 

print_r(json_encode($user_arr));
?>