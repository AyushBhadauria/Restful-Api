<?php
class User{

    private $conn;
    private $table_name = "users";
 
    public $id;
    public $name;
    public $email;
    public $contact;
    public $gender;
    public $about;
    
    public function __construct($db){
        $this->conn = $db;
    }

    //read all users

    function read(){
        $query = "SELECT
                   *
                FROM
                    " . $this->table_name . "
                ORDER BY
                    name";
     
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
     
        return $stmt;
    }

    //create New User
    
    function create(){

        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, email=:email, contact=:contact, gender=:gender, about=:about";
     
                   
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->contact=htmlspecialchars(strip_tags($this->contact));
        $this->gender=htmlspecialchars(strip_tags($this->gender));
        $this->about=htmlspecialchars(strip_tags($this->about));
     
        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":contact", $this->contact);
        $stmt->bindParam(":gender", $this->gender);
        $stmt->bindParam(":about", $this->about);
     
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;
         
    }

    //Read One User
    function readOne(){
        $query = "SELECT
                   *
                FROM
                    " . $this->table_name . " p
                 WHERE
                 p.id = ?
             LIMIT
                 0,1";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->name = $row['name'];
        $this->email = $row['email'];
        $this->about = $row['about'];
        $this->gender = $row['gender'];
        $this->contact = $row['contact'];
    }

// update the User
function update(){
    $query = "UPDATE
                " . $this->table_name . "
            SET
            name = :name,
            email = :email,
            contact = :contact, 
            gender = :gender,
            about = :about
            WHERE
                id = :id";
 
      // sanitize
    $stmt = $this->conn->prepare($query);
    $this->id=htmlspecialchars(strip_tags($this->id));
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->contact=htmlspecialchars(strip_tags($this->contact));
    $this->gender=htmlspecialchars(strip_tags($this->gender));
    $this->about=htmlspecialchars(strip_tags($this->about));
 
    // bind values
    $stmt->bindParam(":id", $this->id);
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":contact", $this->contact);
    $stmt->bindParam(":gender", $this->gender);
    $stmt->bindParam(":about", $this->about);
       
       // execute
    if($stmt->execute()){
        return true;
    }
 
    return false;
}

// delete User
function delete(){

    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
 
    $stmt = $this->conn->prepare($query);

    $this->id=htmlspecialchars(strip_tags($this->id));
 
    $stmt->bindParam(1, $this->id);

    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
}