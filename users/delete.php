<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");

include_once '../config/database.php';
include_once '../object/user.php';
 
$database = new Database();
$dbObj = $database->getConnection();
 

$userObj = new User($dbObj);
 
//storing the client data
$clientData = json_decode(file_get_contents("php://input"));
 

$userObj->id = $clientData->id;
 

if($userObj->delete()){
    echo '{';
        echo '"message": "user was deleted."';
    echo '}';
}

else{
    echo '{';
        echo '"message": "Unable to delete object."';
    echo '}';
}
?>