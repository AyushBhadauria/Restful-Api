<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../config/database.php';
include_once '../object/user.php';
 
$database = new Database();
$dbObject = $database->getConnection();
 
$userObj = new User($dbObject);
 
$stmt = $userObj->read();
$num = $stmt->rowCount();
 

if($num>0){
 
    
    $users_arr=array();
    $users_arr["records"]=array();
 
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $user_item=array(
            "id" => $id,
            "name" => $name,
            "email" => $email,
            "contact" => $contact,
            "gender" => $gender,
            "about" => $about
        );
 
        array_push($users_arr["records"], $user_item);
    }
 
    echo json_encode($users_arr);
}
 
else{
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>