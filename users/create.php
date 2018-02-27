<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");

include_once '../config/database.php';

include_once '../object/user.php';
 
$database = new Database();
$dbObj = $database->getConnection();

//creating user Object
$userObj = new User($dbObj);

//decoding client data
$clientData = json_decode(file_get_contents("php://input"));
 
$userObj->name = $clientData->name;
$userObj->email = $clientData->email;
$userObj->contact = $clientData->contact;
$userObj->gender = $clientData->gender;
$userObj->about = $clientData->about;
 
//calling the create method
if($userObj->create()){
    echo '{';
        echo '"message": "Product was created."';
    echo '}';
}
 

else{
    echo '{';
        echo '"message": "Unable to create product."';
    echo '}';
}
?>