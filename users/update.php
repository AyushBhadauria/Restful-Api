<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");


include_once '../config/database.php';
include_once '../object/user.php';
 
$database = new Database();
$dbObj = $database->getConnection();
 
//creating new user Obj
$userObj = new User($dbObj);

//decoding the client data
$clientData = json_decode(file_get_contents("php://input"));
 
$userObj->id = $clientData->id;
$userObj->name = $clientData->name;
$userObj->email = $clientData->email;
$userObj->contact = $clientData->contact;
$userObj->gender = $clientData->gender;
$userObj->about = $clientData->about;
 
// update the userObj
if($userObj->update()){
    echo '{';
        echo '"message": "user was updated."';
    echo '}';
}
 
// if unable to update the user, tell the user
else{
    echo '{';
        echo '"message": "Unable to update user."';
    echo '}';
}
?>